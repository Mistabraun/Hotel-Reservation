<?php

require_once __DIR__ . "/BaseService.php";

require_once __DIR__ . "/../models/Stay.php";
require_once __DIR__ . "/../models/Reservation.php";

require_once __DIR__ . "/../helper/QueryOptions.php";
require_once __DIR__ . "/../helper/Pagination.php";
require_once __DIR__ . "/../models/Room.php";

class StayService extends BaseService
{
    private Stay $stay;
    private Reservation $reservation;
    private Room $room;

    public function __construct()
    {
        $this->stay = new Stay();
        $this->reservation = new Reservation();
        $this->room = new Room();
    }

    public function getTodayArrivals(array $query): array
    {
        $options = QueryOptions::fromArray($query);

        $arrivals = $this->stay->getTodayArrivals($options);

        $total = $this->stay->countTodayArrivals();

        return $this->success(
            "Today's arrivals retrieved successfully.",
            Pagination::create(
                $arrivals,
                $options,
                $total
            )
        );
    }

    public function getCurrentGuests(array $query): array
    {
        $options = QueryOptions::fromArray($query);

        $guests = $this->stay->getCurrentGuests($options);

        $total = $this->stay->countCurrentGuests();

        return $this->success(
            "Current guests retrieved successfully.",
            Pagination::create(
                $guests,
                $options,
                $total
            )
        );
    }

    public function getCheckedOut(array $query): array
    {
        $options = QueryOptions::fromArray($query);

        $history = $this->stay->getCheckedOut($options);

        $total = $this->stay->countCheckedOut();

        return $this->success(
            "Checked out guests retrieved successfully.",
            Pagination::create(
                $history,
                $options,
                $total
            )
        );
    }

    public function checkIn(int $reservationId): array
    {
        if ($reservationId <= 0) {
            return $this->error("Invalid reservation.");
        }

        $reservation = $this->reservation->findById($reservationId);

        if (!$reservation) {
            return $this->error("Reservation not found.");
        }

        if ($this->stay->isCheckedIn($reservationId)) {
            return $this->error("Guest is already checked in.");
        }

        if (!$this->stay->create($reservationId)) {
            return $this->error("Unable to check in guest.");
        }

        return $this->success(
            "Guest checked in successfully."
        );
    }

    public function checkOut(int $reservationId): array
    {
        if ($reservationId <= 0) {
            return $this->error("Invalid reservation.");
        }

        $stay = $this->stay->findByReservationId($reservationId);

        if (!$stay) {
            return $this->error("Guest has not checked in.");
        }

        if (!empty($stay["checked_out_at"])) {
            return $this->error("Guest has already checked out.");
        }

        if (!$this->stay->checkOut($reservationId)) {
            return $this->error("Unable to check out guest.");
        }

        return $this->success(
            "Guest checked out successfully."
        );
    }

    public function getSummary(): array
    {
        return $this->success(
            "Stay summary retrieved successfully.",
            [
                "arrivals" => $this->stay->countTodayArrivals(),
                "checked_in" => $this->stay->countCurrentGuests(),
                "checked_out" => $this->stay->countCheckedOut(),
                "available_rooms" => $this->room->countAvailable()
            ]
        );
    }
}
