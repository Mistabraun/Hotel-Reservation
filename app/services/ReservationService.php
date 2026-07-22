<?php

require_once __DIR__ . "/BaseService.php";

require_once __DIR__ . "/../models/Reservation.php";
require_once __DIR__ . "/../models/Room.php";
require_once __DIR__ . "/../models/Customer.php";

require_once __DIR__ . "/../services/SessionService.php";

require_once __DIR__ . "/../helper/QueryOptions.php";
require_once __DIR__ . "/../helper/Pagination.php";

class ReservationService extends BaseService
{
    private Reservation $reservation;
    private Room $room;
    private Customer $customer;
    private SessionService $session;

    public function __construct()
    {

        $this->reservation = new Reservation();
        $this->room = new Room();
        $this->customer = new Customer();
        $this->session = new SessionService();
        $this->session->start();
    }


    private function generateBookingReference(): string
    {
        $year = date("Y");

        $count = $this->reservation->countAll() + 1;

        return sprintf(
            "GH-%s-%04d",
            $year,
            $count
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
        $roomId = (int)($data["room_id"] ?? 0);
        $checkIn = trim($data["check_in"] ?? "");
        $checkOut = trim($data["check_out"] ?? "");
        $guestCount = (int)($data["guests"] ?? 1);
        $statusId = (int)($data["status"] ?? 1);


        if (!$this->session->isAuthenticated()) {
            $this->error("Unauthorized");
        }

        $userId = $this->session->getUserId();

        if (
            $roomId <= 0 ||
            empty($checkIn) ||
            empty($checkOut) ||
            empty($userId) ||
            $guestCount <= 0 ||
            $statusId <= 0
        ) {
            return $this->error(
                "Please complete all required fields."
            );
        }


        $customer = $this->customer->findByUserId($userId);

        if (!$customer) {
            return $this->error("Customer not found.");
        }

        $customerId = $customer["id"];

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

        if ($guestCount > $room["capacity"]) {
            return $this->error("Invalid guest amount.");
        }

        // Generate booking reference
        $bookingReference = $this->generateBookingReference();

        $reservationId = $this->reservation->create(
            $bookingReference,
            $customerId,
            $roomId,
            $checkIn,
            $checkOut,
            $guestCount,
            $statusId
        );

        if (!$reservationId) {
            return $this->error(
                "Failed to create reservation."
            );
        }

        return $this->success(
            "Reservation created successfully.",
            [
                "id" => $reservationId
            ]
        );
    }

    public function update(int $id, array $data): array
    {

        $roomId = (int)($data["room_id"] ?? 0);
        $checkIn = trim($data["check_in"] ?? "");
        $checkOut = trim($data["check_out"] ?? "");
        $guestCount = (int)($data["guests"] ?? 1);
        $statusId = (int)($data["status"] ?? 1);

        if (
            $roomId <= 0 ||
            empty($checkIn) ||
            empty($checkOut) ||
            $guestCount <= 0 ||
            $statusId <= 0
        ) {
            return $this->error(
                "Please complete all required fields."
            );
        }


        if (!$this->session->isAuthenticated()) {
            $this->error("Unauthorized");
        }

        $userId = $this->session->getUserId();


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

        $customer = $this->customer->findByUserId($userId);

        if (!$customer) {
            return $this->error("Customer not found.");
        }

        if (!$this->session->isAdmin()) {
            if ($customer["id"] !== $exists["customer_id"]) {
                return $this->error("Unauthorized");
            }
        }

        $success = $this->reservation->update(
            $id,
            $roomId,
            $checkIn,
            $checkOut,
            $guestCount,
            $statusId
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
