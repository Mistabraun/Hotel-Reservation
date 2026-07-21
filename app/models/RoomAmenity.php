<?php
require_once __DIR__ . "/../../config/Database.php";

class RoomAmenity
{
    private mysqli $connection;

    public function __construct()
    {
        $this->connection = Database::connect();
    }
    public function getByRoomId(int $roomId): array
    {
        $sql = "
        SELECT
            a.id,
            a.name
        FROM room_amenities ra
        INNER JOIN amenities a
            ON ra.amenity_id = a.id
        WHERE ra.room_id = ?
        ORDER BY a.name ASC
    ";

        $statement = mysqli_prepare($this->connection, $sql);

        mysqli_stmt_bind_param(
            $statement,
            "i",
            $roomId
        );

        mysqli_stmt_execute($statement);

        $result = mysqli_stmt_get_result($statement);

        return mysqli_fetch_all(
            $result,
            MYSQLI_ASSOC
        );
    }


    public function add(int $roomId, int $amenityId): bool
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

    public function deleteAll(int $roomId): bool
    {
        $sql = "DELETE FROM room_amenities
            WHERE room_id = ?";

        $statement = mysqli_prepare($this->connection, $sql);
        mysqli_stmt_bind_param($statement, "i", $roomId);

        return mysqli_stmt_execute($statement);
    }
}
