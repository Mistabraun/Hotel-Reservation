<?php

require_once __DIR__ . "/BaseService.php";
require_once __DIR__ . "/../models/Guest.php";

class GuestService extends BaseService
{
    private Guest $guest;

    public function __construct()
    {


        $this->guest = new Guest();
    }

    public function getSummary(): array
    {
        return $this->success(
            "Guest summary retrieved successfully.",
            $this->guest->getSummary()
        );
    }

    public function getGuests(
        array $filters = []
    ): array {

        return $this->success(
            "Guests retrieved successfully.",
            $this->guest->getGuests($filters)
        );
    }

    public function getGuestById(
        int $customerId
    ): array {

        if ($customerId <= 0) {
            return $this->error(
                "Invalid customer."
            );
        }

        $guest = $this->guest->getGuestById(
            $customerId
        );

        if (!$guest) {
            return $this->error(
                "Guest not found."
            );
        }

        return $this->success(
            "Guest retrieved successfully.",
            $guest
        );
    }

    public function getReservationHistory(
        int $customerId
    ): array {

        if ($customerId <= 0) {
            return $this->error(
                "Invalid customer."
            );
        }

        $guest = $this->guest->getGuestById(
            $customerId
        );

        if (!$guest) {
            return $this->error(
                "Guest not found."
            );
        }

        return $this->success(
            "Reservation history retrieved successfully.",
            $this->guest->getReservationHistory(
                $customerId
            )
        );
    }
}
