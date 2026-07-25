<?php

require_once __DIR__ . "/../../config/Database.php";

class CustomerProfile
{
    private mysqli $connection;

    public function __construct()
    {
        $this->connection = Database::connect();
    }

    public function findByUserId(
        int $userId
    ): ?array {

        $sql = "
            SELECT

            c.id,
            c.user_id,

            c.first_name,
            c.last_name,

            CONCAT(
                c.first_name,
                ' ',
                c.last_name
            ) AS full_name,

            u.email,

            c.phone_number
            

        FROM customers c

        INNER JOIN users u
            ON u.id = c.user_id

        WHERE c.user_id = ?

        LIMIT 1
        ";

        $statement = mysqli_prepare(
            $this->connection,
            $sql
        );

        mysqli_stmt_bind_param(
            $statement,
            "i",
            $userId
        );

        mysqli_stmt_execute($statement);

        $result = mysqli_stmt_get_result($statement);

        return mysqli_fetch_assoc($result) ?: null;
    }
}
