<?php

require_once __DIR__ . "/../../config/Database.php.php";

class Room
{
    private mysqli $connection;

    public function __construct()
    {
        $this->connection = Database::connect();
    }

    public function create(string $roomName): int|false
    {
        $sql = "INSERT INTO rooms (room_name)
                VALUES (?)";

        $statement = mysqli_prepare($this->connection, $sql);
        mysqli_stmt_bind_param($statement, "s", $roomName);

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
