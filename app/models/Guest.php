<?php

require_once __DIR__ . "/../../config/Database.php";

class Guest
{
    private mysqli $connection;
    private const EXTRA_GUEST_FEE = 250;

    public function __construct()
    {
        $this->connection = Database::connect();
    }

    private function getRoomPricing(int $roomId): ?array
    {
        $sql = "
        SELECT
            price_per_night,
            capacity
        FROM rooms
        WHERE id = ?
        LIMIT 1
    ";

        $statement = mysqli_prepare(
            $this->connection,
            $sql
        );

        mysqli_stmt_bind_param(
            $statement,
            "i",
            $roomId
        );

        mysqli_stmt_execute($statement);

        $result = mysqli_stmt_get_result($statement);

        return mysqli_fetch_assoc($result) ?: null;
    }

    public function calculate(
        int $roomId,
        string $checkIn,
        string $checkOut,
        int $guestCount
    ): array {

        $room = $this->getRoomPricing($roomId);

        if (!$room) {
            return [
                "success" => false,
                "message" => "Room not found."
            ];
        }

        $checkInDate = new DateTime($checkIn);
        $checkOutDate = new DateTime($checkOut);

        $nights = $checkInDate->diff($checkOutDate)->days;

        $includedGuests = (int)$room["capacity"];

        $extraGuests = max(
            0,
            $guestCount - $includedGuests
        );

        $extraGuestFeePerNight = $extraGuests * self::EXTRA_GUEST_FEE;

        $nightlyRate =
            (float)$room["price_per_night"] +
            $extraGuestFeePerNight;

        $totalAmount =
            $nightlyRate * $nights;

        return [
            "success" => true,
            "data" => [
                "nights" => $nights,
                "room_price" => (float)$room["price_per_night"],
                "included_guests" => $includedGuests,
                "guest_count" => $guestCount,
                "extra_guests" => $extraGuests,
                "extra_guest_fee_per_night" => $extraGuestFeePerNight,
                "nightly_rate" => $nightlyRate,
                "total_amount" => $totalAmount
            ]
        ];
    }
}
