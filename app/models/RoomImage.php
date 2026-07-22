<?php

require_once __DIR__ . "/../../config/Database.php";

class RoomImage
{
    private mysqli $connection;

    public function __construct()
    {
        $this->connection = Database::connect();
    }

    public function create(
        int $roomId,
        ?string $thumbnail,
        ?string $coverImage
    ): bool {

        $sql = "
            INSERT INTO room_images (
                room_id,
                thumbnail,
                cover_image
            )
            VALUES (?, ?, ?)
        ";

        $statement = mysqli_prepare(
            $this->connection,
            $sql
        );

        mysqli_stmt_bind_param(
            $statement,
            "iss",
            $roomId,
            $thumbnail,
            $coverImage
        );

        return mysqli_stmt_execute($statement);
    }

    public function update(
        int $roomId,
        ?string $thumbnail,
        ?string $coverImage
    ): bool {

        $sql = "
            UPDATE room_images
            SET
                thumbnail = ?,
                cover_image = ?
            WHERE room_id = ?
        ";

        $statement = mysqli_prepare(
            $this->connection,
            $sql
        );

        mysqli_stmt_bind_param(
            $statement,
            "ssi",
            $thumbnail,
            $coverImage,
            $roomId
        );

        return mysqli_stmt_execute($statement);
    }

    public function findByRoomId(
        int $roomId
    ): ?array {

        $sql = "
            SELECT *
            FROM room_images
            WHERE room_id = ?
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

    public function deleteByRoomId(
        int $roomId
    ): bool {

        $sql = "
            DELETE FROM room_images
            WHERE room_id = ?
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

        return mysqli_stmt_execute($statement);
    }
}
