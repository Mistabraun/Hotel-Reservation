<?php
require_once __DIR__ . "/../../config/Database.php";

class RTA
{
    private mysqli $connection;

    public function __construct()
    {
        $this->connection = Database::connect();
    }


    public function addAmenity(
        int $roomTypeId,
        int $amenityId
    ): bool {

        $sql = "
            INSERT INTO room_type_amenities (
                room_type_id,
                amenity_id
            )
            VALUES (?, ?)
        ";

        $statement = mysqli_prepare($this->connection, $sql);

        mysqli_stmt_bind_param(
            $statement,
            "ii",
            $roomTypeId,
            $amenityId
        );

        return mysqli_stmt_execute($statement);
    }


    public function deleteByRoomTypeId(int $roomTypeId): bool
    {
        $sql = "
            DELETE FROM room_type_amenities
            WHERE room_type_id = ?
        ";

        $statement = mysqli_prepare($this->connection, $sql);

        mysqli_stmt_bind_param(
            $statement,
            "i",
            $roomTypeId
        );

        return mysqli_stmt_execute($statement);
    }


    public function replace(
        int $roomTypeId,
        array $amenityIds
    ): bool {

        if (!$this->deleteByRoomTypeId($roomTypeId)) {
            return false;
        }

        foreach ($amenityIds as $amenityId) {

            if (
                !$this->addAmenity(
                    $roomTypeId,
                    (int)$amenityId
                )
            ) {
                return false;
            }
        }

        return true;
    }


    public function getByRoomTypeId(int $roomTypeId): array
    {
        $sql = "
            SELECT
                a.id,
                a.name
            FROM room_type_amenities rta
            INNER JOIN amenities a
                ON rta.amenity_id = a.id
            WHERE rta.room_type_id = ?
            ORDER BY a.name ASC
        ";

        $statement = mysqli_prepare($this->connection, $sql);

        mysqli_stmt_bind_param(
            $statement,
            "i",
            $roomTypeId
        );

        mysqli_stmt_execute($statement);

        $result = mysqli_stmt_get_result($statement);

        return mysqli_fetch_all(
            $result,
            MYSQLI_ASSOC
        );
    }
}
