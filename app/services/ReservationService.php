<?php

require_once __DIR__ . "/BaseService.php";
require_once __DIR__ . "/../models/Reservation.php";
require_once __DIR__ . "/../models/Room.php";
require_once __DIR__ . "/../models/Customer.php";
require_once __DIR__ . "/../helper/QueryOptions.php";
require_once __DIR__ . "/../helper/Pagination.php";
require_once __DIR__ . "/../services/SessionService.php";

class ReservationService extends BaseService
{
    private Reservation $reservation;
    private Room $room;
    private Customer $customer;
    private SessionService $session;

    public function __construct()
    {
        parent::__construct();

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
        $guestCount = (int)($data["guest_count"] ?? 1);

        if (
            $roomId <= 0 ||
            empty($checkIn) ||
            empty($checkOut)
        ) {
            return $this->error(
                "Please complete all required fields."
            );
        }

        // TODO:
        // Verify customer exists
        $userId = $this->session->getUserId();
        if (!$userId) {
            return $this->error(
                "Invalid authenticatin."
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

        // TODO:
        // Verify room availability
        if ($room["status_id"] !== 3) {
            return $this->error(
                "Room is not available."
            );
        }

        // Generate booking reference
        $bookingReference = $this->generateBookingReference();

        // Pending
        $statusId = 1;

        // Calculate nights
        $checkInDate = new DateTime($checkIn);
        $checkOutDate = new DateTime($checkOut);

        $nights = $checkInDate->diff($checkOutDate)->days;

        if ($nights <= 0) {
            return $this->error(
                "Check-out date must be after check-in date."
            );
        }

        $totalAmount =
            $room["price_per_night"] * $nights;

        $reservationId = $this->reservation->create(
            $bookingReference,
            $customerId,
            $roomId,
            $checkIn,
            $checkOut,
            $guestCount,
            $totalAmount,
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
        if ($id <= 0) {
            return $this->error("Invalid reservation.");
        }

        $exists = $this->reservation->findById($id);

        if (!$exists) {
            return $this->error("Reservation not found.");
        }

        $statusId = (int)($data["status_id"] ?? 0);

        if ($statusId <= 0) {
            return $this->error("Please select a reservation status.");
        }

        $success = $this->reservation->update(
            $id,
            (int)$data["room_id"],
            $data["check_in"],
            $data["check_out"],
            (int)$data["guest_count"],
            (float)$data["total_amount"],
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
}
