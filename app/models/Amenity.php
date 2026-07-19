<?php

require_once __DIR__ . "/../../config/Database.php";

class Amenity
{
    private mysqli $connection;

    public function __construct()
    {
        $this->connection = Database::connect();
    }


    public function findByName(string $name): ?array
    {
        $sql = "SELECT *
            FROM amenities
            WHERE name = ?
            LIMIT 1";

        $statement = mysqli_prepare($this->connection, $sql);
        mysqli_stmt_bind_param($statement, "s", $name);
        mysqli_stmt_execute($statement);

        $result = mysqli_stmt_get_result($statement);

        return mysqli_fetch_assoc($result) ?: null;
    }

    public function findById(int $id): ?array
    {
        $sql = "SELECT *
            FROM amenities
            WHERE id = ?
            LIMIT 1";

        $statement = mysqli_prepare($this->connection, $sql);
        mysqli_stmt_bind_param($statement, "i", $id);
        mysqli_stmt_execute($statement);

        $result = mysqli_stmt_get_result($statement);

        return mysqli_fetch_assoc($result) ?: null;
    }

    public function getAll(): array
    {
        $sql = "SELECT id, name
            FROM amenities
            ORDER BY id ASC";

        $result = mysqli_query($this->connection, $sql);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}
