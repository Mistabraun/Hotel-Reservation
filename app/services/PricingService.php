<?php

require_once __DIR__ . "/BaseService.php";

require_once __DIR__ . "/../models/Room.php";
require_once __DIR__ . "/../models/Reservation.php";

class PricingService extends BaseService
{
    private const EXTRA_GUEST_FEE = 250;

    private Room $room;
    private Reservation $reservation;

    public function __construct()
    {

        $this->room = new Room();
        $this->reservation = new Reservation();
    }

    public function calculateByRoomId(
        int $roomId,
        int $guestCount,
        string $checkIn,
        string $checkOut
    ): array {

        $room = $this->room->findById($roomId);

        if (!$room) {
            return $this->error("Room not found.");
        }

        return $this->calculate(
            (float)$room["price_per_night"],
            (int)$room["capacity"],
            $guestCount,
            $checkIn,
            $checkOut
        );
    }

    public function calculateByReservationId(
        int $reservationId
    ): array {

        $reservation = $this->reservation->findById($reservationId);

        if (!$reservation) {
            return $this->error("Reservation not found.");
        }

        $room = $this->room->findById(
            (int)$reservation["room_id"]
        );

        if (!$room) {
            return $this->error("Room not found.");
        }

        $guestCount =
            (int)$reservation["adults"] +
            (int)$reservation["children"];

        return $this->calculate(
            (float)$room["price_per_night"],
            (int)$room["capacity"],
            $guestCount,
            $reservation["check_in"],
            $reservation["check_out"]
        );
    }

    public function calculate(
        float $pricePerNight,
        int $capacity,
        int $guestCount,
        string $checkIn,
        string $checkOut
    ): array {

        $checkInDate = new DateTime($checkIn);
        $checkOutDate = new DateTime($checkOut);

        $nights = $checkInDate
            ->diff($checkOutDate)
            ->days;

        $extraGuests = max(
            0,
            $guestCount - $capacity
        );

        $extraGuestFeePerNight =
            $extraGuests * self::EXTRA_GUEST_FEE;

        $nightlyRate =
            $pricePerNight + $extraGuestFeePerNight;

        $totalAmount =
            $nightlyRate * $nights;

        return $this->success(
            "Pricing calculated successfully.",
            [
                "room_price_per_night" => $pricePerNight,

                "included_capacity" => $capacity,

                "guest_count" => $guestCount,

                "extra_guest_count" => $extraGuests,

                "extra_guest_fee" => self::EXTRA_GUEST_FEE,

                "extra_guest_fee_per_night" => $extraGuestFeePerNight,

                "nightly_rate" => $nightlyRate,

                "nights" => $nights,

                "total_amount" => $totalAmount
            ]
        );
    }
}
