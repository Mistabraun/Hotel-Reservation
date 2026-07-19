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

    public function update(
        int $id,
        int $roomNumber,
        string $roomName,
        int $roomTypeId,
        int $statusId,
        float $price,
        int $capacity,
        float $size,
        string $bedType
    ): bool {
        $sql = "
        UPDATE rooms
        SET
            room_number = ?,
            room_name = ?,
            room_type_id = ?,
            status_id = ?,
            price_per_night = ?,
            capacity = ?,
            size = ?,
            bed_type = ?
        WHERE id = ?
    ";

        $statement = mysqli_prepare($this->connection, $sql);

        mysqli_stmt_bind_param(
            $statement,
            "isiididsi",
            $roomNumber,
            $roomName,
            $roomTypeId,
            $statusId,
            $price,
            $capacity,
            $size,
            $bedType,
            $id
        );

        return mysqli_stmt_execute($statement);
    }

    public function delete(int $id): bool
    {
        $sql = "DELETE FROM rooms WHERE id = ?";

        $statement = mysqli_prepare($this->connection, $sql);
        mysqli_stmt_bind_param($statement, "i", $id);

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
        $sql = "
        SELECT
            r.*,
            rt.name AS room_type,
            rs.name AS status
        FROM rooms r
        INNER JOIN room_types rt
            ON rt.id = r.room_type_id
        INNER JOIN room_statuses rs
            ON rs.id = r.status_id
        WHERE r.id = ?
    ";

        $statement = mysqli_prepare($this->connection, $sql);
        mysqli_stmt_bind_param($statement, "i", $id);
        mysqli_stmt_execute($statement);

        $result = mysqli_stmt_get_result($statement);

        return mysqli_fetch_assoc($result) ?: null;
    }

    public function count(): int
    {
        $sql = "SELECT COUNT(*) AS total FROM rooms";

        $result = mysqli_query($this->connection, $sql);

        return (int)mysqli_fetch_assoc($result)["total"];
    }

    public function getAll(int $offset, int $limit): array
    {
        $sql = "
        SELECT
            r.id,
            r.room_number,
            r.room_name,
            rt.name AS room_type,
            rs.name AS status,
            r.price_per_night,
            r.capacity,
            r.size,
            r.bed_type
        FROM rooms r
        INNER JOIN room_types rt
            ON rt.id = r.room_type_id
        INNER JOIN room_statuses rs
            ON rs.id = r.status_id
        ORDER BY r.room_number
        LIMIT ?, ?
    ";

        $statement = mysqli_prepare($this->connection, $sql);
        mysqli_stmt_bind_param($statement, "ii", $offset, $limit);
        mysqli_stmt_execute($statement);

        $result = mysqli_stmt_get_result($statement);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}
