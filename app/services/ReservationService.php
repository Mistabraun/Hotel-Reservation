<?php

require_once __DIR__ . "/BaseService.php";

require_once __DIR__ . "/../models/Reservation.php";
require_once __DIR__ . "/../models/Room.php";
require_once __DIR__ . "/../models/Customer.php";
require_once __DIR__ . "/../models/User.php";

require_once __DIR__ . "/../services/SessionService.php";

require_once __DIR__ . "/../helper/QueryOptions.php";
require_once __DIR__ . "/../helper/Pagination.php";

require_once __DIR__ . "/../../config/Database.php";


class ReservationService extends BaseService
{
    private Reservation $reservation;
    private Room $room;
    private Customer $customer;
    private SessionService $session;
    private mysqli $connection;
    private User $user;

    private static string $PASSWORD;

    public function __construct()
    {

        $this->connection = Database::connect();
        $this->reservation = new Reservation();
        $this->room = new Room();
        $this->user = new User();
        $this->customer = new Customer();
        $this->session = new SessionService();
        $this->session->start();

        self::$PASSWORD = password_hash(".__TEMPORARY PASSWORD__.", PASSWORD_DEFAULT);
    }




    public function generateBookingReference(): string
    {

        $year = date("Y");
        $next = $this->reservation->getNextReferenceNumber();

        return sprintf(
            "GH-%s-%04d",
            $year,
            $next
        );
    }


    public function getAll(array $query): array
    {
        $options = QueryOptions::fromArray($query);

        $reservations = $this->reservation->getAll($options);

        $total = $this->reservation->count($options);

        return $this->success(
            "Reservations retrieved successfully.",
            Pagination::create(
                $reservations,
                $options,
                $total
            )
        );
    }

    public function getById(int $id): array
    {
        if ($id <= 0) {
            return $this->error("Invalid reservation.");
        }

        $reservation = $this->reservation->findById($id);

        if (!$reservation) {
            return $this->error("Reservation not found.");
        }

        return $this->success(
            "Reservation retrieved successfully.",
            $reservation
        );
    }


    public function create(array $data): array
    {
        $firstName = trim($data["first_name"] ?? "");
        $lastName = trim($data["last_name"] ?? "");
        $email = trim($data["email"] ?? "");
        $phone = trim($data["phone"] ?? "");

        $roomId = (int)($data["room_id"] ?? 0);

        $checkIn = trim($data["check_in"] ?? "");
        $checkOut = trim($data["check_out"] ?? "");

        $guestCount = (int)($data["guests"] ?? 1);

        $statusId = (int)($data["status"] ?? 1);

        $requests = trim($data["special_requests"] ?? "");

        if ($firstName === "") {
            return $this->error("First name is required.");
        }

        if ($lastName === "") {
            return $this->error("Last name is required.");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->error("Invalid email address.");
        }

        if ($phone === "") {
            return $this->error("Phone number is required.");
        }

        if ($roomId <= 0) {
            return $this->error("Please select a room.");
        }

        if ($checkIn === "" || $checkOut === "") {
            return $this->error("Reservation dates are required.");
        }

        if (strtotime($checkIn) >= strtotime($checkOut)) {
            return $this->error("Check-out must be after check-in.");
        }


        $room = $this->room->findById($roomId);
        if (!$room) {
            return $this->error(
                "Room does not exist."
            );
        }

        if ($room["status_id"] !== 1) {
            return $this->error(
                "Room is not available."
            );
        }

        if ($guestCount <= 0) {
            return $this->error("At least one guest is required.");
        }

        if ($guestCount > 12) {
            return $this->error(
                "Maximum of 12 guests per reservation."
            );
        }

        $today = new DateTime("today");
        $tomorrow = new DateTime("tomorrow");

        try {

            $checkInDate = new DateTime($checkIn);
            $checkOutDate = new DateTime($checkOut);
        } catch (Exception $e) {

            return $this->error(
                "Invalid reservation dates."
            );
        }

        if ($checkInDate < $tomorrow) {

            return $this->error(
                "Check-in must be at least tomorrow."
            );
        }

        if ($checkOutDate <= $checkInDate) {

            return $this->error(
                "Check-out must be after check-in."
            );
        }

        if (
            $this->reservation->hasConflictingReservation(
                $roomId,
                $checkIn,
                $checkOut
            )
        ) {
            return $this->error(
                "The selected room is already reserved for the selected dates."
            );
        }

        // Generate booking reference
        $bookingReference = $this->generateBookingReference();


        mysqli_begin_transaction($this->connection);

        try {

            $user = $this->user->findByEmail($email);
            $userId = 0;

            if (!$user) {
                $userId = $this->user->create($email, self::$PASSWORD, "2");
            } else {
                $userId = $user["id"];
            }

            $customerId = $this->customer->findByUserId($userId);
            if (!$customerId) {
                $customerId = $this->customer->create(
                    $userId,
                    $firstName,
                    $lastName,
                    $phone
                );;
            } else {
                $customerId = $customerId["id"];
            }

            $reservationId = $this->reservation->create(
                $bookingReference,
                $customerId,
                $roomId,
                $checkIn,
                $checkOut,
                $guestCount,
                $statusId,
                $requests
            );

            if (!$reservationId) {
                throw new Exception("Unable to create reservation.");
            }

            mysqli_commit($this->connection);

            return $this->success(
                "Reservation created successfully.",
                [
                    "reservation_id" => $reservationId
                ]
            );
        } catch (Exception $e) {

            mysqli_rollback($this->connection);

            return $this->error($e->getMessage());
        }
    }

    public function update(int $id, array $data): array
    {

        $firstName = trim($data["first_name"] ?? "");
        $lastName = trim($data["last_name"] ?? "");
        $email = trim($data["email"] ?? "");
        $phone = trim($data["phone"] ?? "");

        $roomId = (int)($data["room_id"] ?? 0);

        $checkIn = trim($data["check_in"] ?? "");
        $checkOut = trim($data["check_out"] ?? "");

        $guestCount = (int)($data["guests"] ?? 1);

        $statusId = (int)($data["status"] ?? 1);

        $requests = trim($data["special_requests"] ?? "");

        if ($firstName === "") {
            return $this->error("First name is required.");
        }

        if ($lastName === "") {
            return $this->error("Last name is required.");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->error("Invalid email address.");
        }

        if ($phone === "") {
            return $this->error("Phone number is required.");
        }

        if ($roomId <= 0) {
            return $this->error("Please select a room.");
        }

        if ($checkIn === "" || $checkOut === "") {
            return $this->error("Reservation dates are required.");
        }

        if (strtotime($checkIn) >= strtotime($checkOut)) {
            return $this->error("Check-out must be after check-in.");
        }

        if ($id <= 0) {
            return $this->error("Invalid reservation.");
        }

        $exists = $this->reservation->findById($id);

        if (!$exists) {
            return $this->error("Reservation not found.");
        }

        $statusId = (int)($data["status"] ?? 0);

        if ($statusId <= 0) {
            return $this->error("Please select a reservation status.");
        }

        if (
            $this->reservation->hasConflictingReservation(
                $roomId,
                $checkIn,
                $checkOut,
                $id
            )
        ) {
            return $this->error(
                "The selected room is already reserved for the selected dates."
            );
        }

        $success = $this->reservation->update(
            $id,
            $roomId,
            $checkIn,
            $checkOut,
            $guestCount,
            $statusId,
            $requests
        );
        if (!$success) {
            return $this->error("Failed to update reservation.");
        }

        return $this->success(
            "Reservation updated successfully."
        );
    }

    public function delete(int $id): array
    {
        if ($id <= 0) {
            return $this->error("Invalid reservation.");
        }

        if (!$this->reservation->findById($id)) {
            return $this->error("Reservation not found.");
        }

        if (!$this->reservation->delete($id)) {
            return $this->error("Failed to delete reservation.");
        }

        return $this->success(
            "Reservation deleted successfully."
        );
    }

    public function getUnavailableDates(int $roomId, int $reservationId): array
    {
        if (!$this->room->findById($roomId)) {
            return $this->error("Invalid room");
        }

        return $this->success(
            "Unavailable dates retrieved successfully.",
            $this->reservation->getUnavailableDates($roomId, $reservationId)
        );
    }

    public function getStatusCounts(): array
    {
        return $this->success(
            "Reservation counts retrieved successfully.",
            [
                "confirmed" => $this->reservation->countByStatus("Confirmed"),
                "pending" => $this->reservation->countByStatus("Pending"),
                "checked_out" => $this->reservation->countByStatus("Checked Out"),
                "cancelled" => $this->reservation->countByStatus("Cancelled")
            ]
        );
    }

    public function countByStatus(string $status): array
    {
        return $this->success(
            "Reservation counts retrieved successfully.",
            $this->reservation->countByStatus($status)
        );
    }
}
