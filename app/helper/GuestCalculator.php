<?php

class GuestCalculator
{
    public const EXTRA_GUEST_FEE = 250;

    public static function calculate(
        float $pricePerNight,
        int $includedCapacity,
        int $guestCount,
        string $checkIn,
        string $checkOut
    ): array {

        $checkInDate = new DateTime($checkIn);
        $checkOutDate = new DateTime($checkOut);

        $nights = $checkInDate->diff($checkOutDate)->days;

        $extraGuests = max(
            0,
            $guestCount - $includedCapacity
        );

        $extraFeePerNight =
            $extraGuests * self::EXTRA_GUEST_FEE;

        $nightlyRate =
            $pricePerNight + $extraFeePerNight;

        $totalAmount =
            $nightlyRate * $nights;

        return [
            "nights" => $nights,
            "guest_count" => $guestCount,
            "extra_guests" => $extraGuests,
            "nightly_rate" => $nightlyRate,
            "total_amount" => $totalAmount
        ];
    }
}
