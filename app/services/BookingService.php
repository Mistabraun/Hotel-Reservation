<?php

require_once __DIR__ . "/BaseService.php";

require_once __DIR__ . "/../services/ReservationService.php";
require_once __DIR__ . "/../services/PaymentService.php";

require_once __DIR__ . "/../helper/ReservationStatus.php";

require_once __DIR__ . "/../models/Booking.php";
require_once __DIR__ . "/../models/Reservation.php";
require_once __DIR__ . "/../models/Payment.php";

require_once __DIR__ . "/../../config/Database.php";


class BookingService extends BaseService
{
    private ReservationService $reservationService;
    private PaymentService $paymentService;
    private Booking $booking;
    private Reservation $reservation;
    private Payment $payment;

    private mysqli $connection;

    public function __construct()
    {
        $this->reservationService = new ReservationService();
        $this->paymentService = new PaymentService();
        $this->booking = new Booking();
        $this->reservation = new Reservation();
        $this->payment = new Payment();

        $this->connection = Database::connect();
    }

    private function generateCardTransactionReference(): string
    {
        return sprintf(
            "CARD-%s-%s",
            date("YmdHis"),
            strtoupper(
                bin2hex(random_bytes(3))
            )
        );
    }

    private function generateSecretKey(): string
    {
        return "BK_" .
            strtoupper(
                bin2hex(random_bytes(12))
            );
    }

    public function book(array $data)
    {
        $paymentMethod = $this->paymentService->getPaymentMethodName(
            $data["payment_method"]
        );

        if (!$paymentMethod["success"]) {
            return $this->error("Invalid payment method.");
        }

        $gcashReference = trim($data["gcash_reference"] ?? "");

        $cardholderName = trim($data["cardholder_name"] ?? "");
        $cardNumber = preg_replace("/\s+/", "", $data["card_number"] ?? "");
        $expiryDate = trim($data["expiry_date"] ?? "");
        $cvv = trim($data["cvv"] ?? "");

        $transactionReference = null;

        switch ($paymentMethod["data"]["name"]) {

            case "GCash":

                if (!preg_match('/^\d{13}$/', $gcashReference)) {
                    return $this->error(
                        "GCash reference number must be exactly 13 digits."
                    );
                }

                $transactionReference = $gcashReference;
                break;

            case "Card":

                if ($cardholderName === "") {
                    return $this->error("Cardholder name is required.");
                }

                if (!preg_match('/^\d{16}$/', $cardNumber)) {
                    return $this->error("Invalid card number.");
                }

                if (!preg_match('/^(0[1-9]|1[0-2])\/\d{2}$/', $expiryDate)) {
                    return $this->error("Invalid expiry date.");
                }

                if (!preg_match('/^\d{3,4}$/', $cvv)) {
                    return $this->error("Invalid CVV.");
                }

                $transactionReference =
                    $this->generateCardTransactionReference();

                break;

            case "Cash":

                $transactionReference = null;
                break;

            default:

                return $this->error("Unsupported payment method.");
        }

        mysqli_begin_transaction($this->connection);

        try {

            $reservation = $this->reservationService->create($data);

            if (!$reservation["success"]) {
                throw new Exception(
                    $reservation["message"]
                );
            }

            $reservationId =
                $reservation["data"]["reservation_id"];

            $payment = $this->paymentService->create([
                "reservation_id" => $reservationId,
                "payment_method_id" => $paymentMethod["data"]["id"],
                "status_id" => 1,
                "transaction_reference" => $transactionReference,
                "paid_at" =>  date('Y-m-d')
            ]);

            if (!$payment["success"]) {
                throw new Exception(
                    $payment["message"]
                );
            }

            $booking = $this->createSecretKey(
                $reservationId
            );

            if (!$booking["success"]) {
                throw new Exception(
                    $booking["message"]
                );
            }

            mysqli_commit($this->connection);

            return $this->success(
                "Successfully booked.",
                [
                    // "reservation_id" => $reservationId,
                    // "payment_id" => $payment["data"]["payment_id"],
                    "secret_key" => $booking["data"]["secret_key"]
                ]
            );
        } catch (Exception $e) {

            mysqli_rollback($this->connection);

            return $this->error(
                $e->getMessage()
            );
        }
    }


    public function createSecretKey(
        int $reservationId
    ): array {

        if ($reservationId <= 0) {
            return $this->error(
                "Invalid reservation."
            );
        }

        if ($this->booking->findByReservationId($reservationId)) {
            return $this->error(
                "A booking already exists for this reservation."
            );
        }

        do {
            $secretKey = $this->generateSecretKey();
        } while (
            $this->booking->findBySecretKey($secretKey)
        );

        $bookingId = $this->booking->create(
            $reservationId,
            $secretKey
        );

        if (!$bookingId) {
            return $this->error(
                "Unable to create booking."
            );
        }

        return $this->success(
            "Booking created successfully.",
            [
                "booking_id" => $bookingId,
                "secret_key" => $secretKey
            ]
        );
    }


    public function viewBySecretKey(
        string $secretKey
    ): array {

        $booking = $this->booking->viewBySecretKey(
            trim($secretKey)
        );

        if (!$booking) {
            return $this->error(
                "Booking not found."
            );
        }

        return $this->success(
            "Booking retrieved successfully.",
            $booking
        );
    }

    public function cancelBySecretKey(
        string $secretKey
    ): array {
        $booking = $this->booking->viewBySecretKey(
            $secretKey
        );

        if (!$booking) {
            return $this->error(
                "Booking not found."
            );
        }

        if ($booking["reservation_status"] === "Cancelled") {
            return $this->error(
                "This reservation has already been cancelled."
            );
        }

        if (!$this->reservation->updatestatus(
            (int)$booking["reservation_id"],
            ReservationStatus::CANCELLED
        )) {
            return $this->error(
                "Unable to cancel reservation."
            );
        }

        if (!$this->payment->updateStatus(
            (int)$booking["payment_id"],
            4
        )) {
            return $this->error(
                "Unable to cancel reservation."
            );
        }

        return $this->success(
            "Reservation cancelled successfully."
        );
    }
}
