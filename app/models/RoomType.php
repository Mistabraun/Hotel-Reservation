<?php
require_once __DIR__ . "/../../config/Database.php";

class RoomType
{
    private mysqli $connection;

    public function __construct()
    {
        $this->connection = Database::connect();
    }

    public function create(
        string $name,
        string $description,
        float $pricePerNight,
        int $capacity
    ): int|false {

        $sql = "
            INSERT INTO room_types (
                name,
                description,
                price_per_night,
                capacity
            )
            VALUES (?, ?, ?, ?)
        ";

        $statement = mysqli_prepare($this->connection, $sql);

        mysqli_stmt_bind_param(
            $statement,
            "ssdi",
            $name,
            $description,
            $pricePerNight,
            $capacity
        );

        if (!mysqli_stmt_execute($statement)) {
            return false;
        }

        return mysqli_insert_id($this->connection);
    }


    public function update(
        int $id,
        string $name,
        string $description,
        float $pricePerNight,
        int $capacity
    ): bool {

        $sql = "
            UPDATE room_types
            SET
                name = ?,
                description = ?,
                price_per_night = ?,
                capacity = ?
            WHERE id = ?
        ";

        $statement = mysqli_prepare($this->connection, $sql);

        mysqli_stmt_bind_param(
            $statement,
            "ssdii",
            $name,
            $description,
            $pricePerNight,
            $capacity,
            $id
        );

        return mysqli_stmt_execute($statement);
    }


    public function delete(int $id): bool
    {
        $sql = "
            DELETE FROM room_types
            WHERE id = ?
        ";

        $statement = mysqli_prepare($this->connection, $sql);

        mysqli_stmt_bind_param(
            $statement,
            "i",
            $id
        );

        return mysqli_stmt_execute($statement);
    }


    public function findById(int $id): array|null
    {
        $sql = "
            SELECT
                id,
                name,
                description,
                price_per_night,
                capacity
            FROM room_types
            WHERE id = ?
            LIMIT 1
        ";

        $statement = mysqli_prepare($this->connection, $sql);

        mysqli_stmt_bind_param(
            $statement,
            "i",
            $id
        );

        mysqli_stmt_execute($statement);

        $result = mysqli_stmt_get_result($statement);

        return mysqli_fetch_assoc($result) ?: null;
    }


    public function getAll(): array
    {
        $sql = "
        SELECT
            id,
            name,
            description,
            price_per_night,
            capacity
        FROM room_types
        ORDER BY price_per_night ASC
    ";

        $result = mysqli_query($this->connection, $sql);

        return mysqli_fetch_all(
            $result,
            MYSQLI_ASSOC
        );
    }


    public function existsByName(
        string $name,
        ?int $ignoreId = null
    ): bool {

        $sql = "
            SELECT id
            FROM room_types
            WHERE LOWER(name) = LOWER(?)
        ";

        if ($ignoreId !== null) {
            $sql .= " AND id <> ?";
        }

        $statement = mysqli_prepare(
            $this->connection,
            $sql
        );

        if ($ignoreId !== null) {

            mysqli_stmt_bind_param(
                $statement,
                "si",
                $name,
                $ignoreId
            );
        } else {

            mysqli_stmt_bind_param(
                $statement,
                "s",
                $name
            );
        }

        mysqli_stmt_execute($statement);

        $result = mysqli_stmt_get_result($statement);

        return mysqli_num_rows($result) > 0;
    }
}
