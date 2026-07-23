<?php

require_once __DIR__ . "/BaseService.php";
require_once __DIR__ . "/../../config/Database.php";

require_once __DIR__ . "/../models/Payment.php";
require_once __DIR__ . "/../models/Reservation.php";

require_once __DIR__ . "/../helper/QueryOptions.php";
require_once __DIR__ . "/../helper/Pagination.php";

class PaymentService extends BaseService
{
    private Payment $payment;
    private Reservation $reservation;
    private mysqli $connection;

    public function __construct()
    {
        $this->payment = new Payment();
        $this->reservation = new Reservation();
        $this->connection = Database::connect();
    }

    /**
     * Generates the next payment reference.
     * Example: PAY-0001
     */
    private function generatePaymentReference(): string
    {
        $count = $this->payment->countAll() + 1;

        return sprintf(
            "PAY-%04d",
            $count
        );
    }

    public function getAvailableReservations(): array
    {
        $reservations = $this->payment->getAvailableReservations();

        return $this->success(
            "Available reservations retrieved successfully.",
            $reservations
        );
    }

    /**
     * Returns paginated payments.
     */
    public function getAll(array $query): array
    {
        $options = QueryOptions::fromArray($query);

        $payments = $this->payment->getAll($options);

        $total = $this->payment->count($options);

        return $this->success(
            "Payments retrieved successfully.",
            Pagination::create(
                $payments,
                $options,
                $total
            )
        );
    }

    /**
     * Returns one payment.
     */
    public function getById(int $id): array
    {
        if ($id <= 0) {
            return $this->error("Invalid payment.");
        }

        $payment = $this->payment->findById($id);

        if (!$payment) {
            return $this->error("Payment not found.");
        }

        return $this->success(
            "Payment retrieved successfully.",
            $payment
        );
    }

    /**
     * Returns available payment methods.
     */
    public function getPaymentMethods(): array
    {
        return $this->success(
            "Payment methods retrieved successfully.",
            $this->payment->getPaymentMethods()
        );
    }

    /**
     * Returns the next payment reference.
     */
    public function getNextReference(): array
    {
        return $this->success(
            "Payment reference generated successfully.",
            [
                "payment_reference" => $this->generatePaymentReference()
            ]
        );
    }

    public function create(array $data): array
    {
        $reservationId = (int)($data["reservation_id"] ?? 0);
        $paymentMethodId = (int)($data["payment_method_id"] ?? 0);
        $statusId = (int)($data["status_id"] ?? 1);

        $transactionReference = trim(
            $data["transaction_reference"] ?? ""
        );

        $paidAt = trim(
            $data["paid_at"] ?? ""
        );

        if ($reservationId <= 0) {
            return $this->error("Please select a reservation.");
        }

        if ($paymentMethodId <= 0) {
            return $this->error("Please select a payment method.");
        }

        if ($statusId <= 0) {
            return $this->error("Please select a payment status.");
        }

        $reservation = $this->reservation->findById(
            $reservationId
        );

        if (!$reservation) {
            return $this->error("Reservation not found.");
        }

        if ($this->payment->findByReservationId($reservationId)) {
            return $this->error(
                "A payment already exists for this reservation."
            );
        }

        $paymentReference = $this->generatePaymentReference();
        
        $amount = (float)$reservation["total_amount"];

        if ($statusId === 2 && empty($paidAt)) {
            $paidAt = date("Y-m-d H:i:s");
        }

        if ($statusId !== 2) {
            $paidAt = null;
        }

        mysqli_begin_transaction($this->connection);

        try {

            $paymentId = $this->payment->create(
                $paymentReference,
                $reservationId,
                $paymentMethodId,
                $statusId,
                $amount,
                $transactionReference ?: null,
                $paidAt
            );

            if (!$paymentId) {
                throw new Exception(
                    "Unable to create payment."
                );
            }

            mysqli_commit($this->connection);

            return $this->success(
                "Payment created successfully.",
                [
                    "payment_id" => $paymentId
                ]
            );
        } catch (Exception $e) {

            mysqli_rollback($this->connection);

            return $this->error(
                $e->getMessage()
            );
        }
    }

    public function update(
        int $id,
        array $data
    ): array {

        if ($id <= 0) {
            return $this->error("Invalid payment.");
        }

        if (!$this->payment->findById($id)) {
            return $this->error("Payment not found.");
        }

        $paymentMethodId = (int)($data["payment_method_id"] ?? 0);
        $statusId = (int)($data["status_id"] ?? 0);

        $transactionReference = trim(
            $data["transaction_reference"] ?? ""
        );

        $paidAt = trim(
            $data["paid_at"] ?? ""
        );

        if ($paymentMethodId <= 0) {
            return $this->error("Please select a payment method.");
        }

        if ($statusId <= 0) {
            return $this->error("Please select a payment status.");
        }

        $payment = $this->payment->findById($id);

        $amount = (float)$payment["amount"];

        if ($statusId == 2 && empty($paidAt)) {
            $paidAt = date("Y-m-d H:i:s");
        }

        if ($statusId != 2) {
            $paidAt = null;
        }

        mysqli_begin_transaction($this->connection);

        try {

            if (
                !$this->payment->update(
                    $id,
                    $paymentMethodId,
                    $statusId,
                    $amount,
                    $transactionReference ?: null,
                    $paidAt
                )
            ) {
                throw new Exception(
                    "Unable to update payment."
                );
            }

            mysqli_commit($this->connection);

            return $this->success(
                "Payment updated successfully."
            );
        } catch (Exception $e) {

            mysqli_rollback($this->connection);

            return $this->error(
                $e->getMessage()
            );
        }
    }

    public function confirm(int $id): array
    {
        if ($id <= 0) {
            return $this->error("Invalid payment.");
        }

        if (!$this->payment->findById($id)) {
            return $this->error("Payment not found.");
        }

        if (
            !$this->payment->updateStatus(
                $id,
                2,
                date("Y-m-d H:i:s")
            )
        ) {
            return $this->error(
                "Unable to confirm payment."
            );
        }

        return $this->success(
            "Payment confirmed successfully."
        );
    }

    public function refund(int $id): array
    {
        if ($id <= 0) {
            return $this->error("Invalid payment.");
        }

        if (!$this->payment->findById($id)) {
            return $this->error("Payment not found.");
        }

        if (
            !$this->payment->updateStatus(
                $id,
                3,
                null
            )
        ) {
            return $this->error(
                "Unable to refund payment."
            );
        }

        return $this->success(
            "Payment refunded successfully."
        );
    }

    public function delete(int $id): array
    {
        if ($id <= 0) {
            return $this->error("Invalid payment.");
        }

        if (!$this->payment->findById($id)) {
            return $this->error("Payment not found.");
        }

        if (!$this->payment->delete($id)) {
            return $this->error(
                "Unable to delete payment."
            );
        }

        return $this->success(
            "Payment deleted successfully."
        );
    }

    public function getStatusCounts(): array
    {
        return $this->success(
            "Payment statistics retrieved successfully.",
            [
                "pending" => $this->payment->countByStatus("Pending"),
                "paid" => $this->payment->countByStatus("Paid"),
                "refunded" => $this->payment->countByStatus("Refunded"),
                "failed" => $this->payment->countByStatus("Failed"),
            ]
        );
    }


    public function updateStatus(
        int $id,
        int $statusId,
        ?string $paidAt = null
    ): bool {

        $statement = mysqli_prepare(
            $this->connection,
            "
            UPDATE payments
            SET
                status_id = ?,
                paid_at = ?
            WHERE id = ?
        "
        );

        mysqli_stmt_bind_param(
            $statement,
            "isi",
            $statusId,
            $paidAt,
            $id
        );

        return mysqli_stmt_execute($statement);
    }
}
