<?php

require_once __DIR__ . "/../../config/Database.php";

class Room
{
    private mysqli $connection;

    public function __construct()
    {
        $this->connection = Database::connect();
    }
    public function create(
        string $roomName,
        int $roomTypeId,
        int $statusId,
        int $roomNumber,
        float $pricePerNight,
        int $capacity,
        string $size,
        string $bedType
    ): int|false {
        $sql = "
        INSERT INTO rooms (
            room_name,
            room_type_id,
            status_id,
            room_number,
            price_per_night,
            capacity,
            size,
            bed_type
        )
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    ";

        $statement = mysqli_prepare($this->connection, $sql);

        mysqli_stmt_bind_param(
            $statement,
            "siiidiss",
            $roomName,
            $roomTypeId,
            $roomNumber,
            $statusId,
            $pricePerNight,
            $capacity,
            $size,
            $bedType
        );

        if (!mysqli_stmt_execute($statement)) {
            return false;
        }

        return mysqli_insert_id($this->connection);
    }

    public function addAmenity(int $roomId, int $amenityId): bool
    {
        $sql = "INSERT INTO room_amenities (room_id, amenity_id)
                VALUES (?, ?)";

        $statement = mysqli_prepare($this->connection, $sql);
        mysqli_stmt_bind_param(
            $statement,
            "ii",
            $roomId,
            $amenityId
        );

        return mysqli_stmt_execute($statement);
    }

    public function findByRoomNumber(int $roomNumber): ?array
    {
        $sql = "SELECT *
            FROM rooms
            WHERE room_number = ?
            LIMIT 1";

        $statement = mysqli_prepare($this->connection, $sql);
        mysqli_stmt_bind_param($statement, "i", $roomNumber);
        mysqli_stmt_execute($statement);

        $result = mysqli_stmt_get_result($statement);

        return mysqli_fetch_assoc($result) ?: null;
    }

    public function findById(int $id): ?array
    {
        $sql = "SELECT *
            FROM rooms
            WHERE id = ?
            LIMIT 1";

        $statement = mysqli_prepare($this->connection, $sql);
        mysqli_stmt_bind_param($statement, "i", $id);
        mysqli_stmt_execute($statement);

        $result = mysqli_stmt_get_result($statement);

        return mysqli_fetch_assoc($result) ?: null;
    }
}
