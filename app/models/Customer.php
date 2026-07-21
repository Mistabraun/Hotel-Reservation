<?php


require_once __DIR__ . "/../../config/Database.php";

class Customer
{
    private mysqli $connection;

    public function __construct()
    {
        $this->connection = Database::connect();
    }

    public function create(
        int $userId,
        string $firstName,
        string $lastName,
        string $phoneNumber
    ): int|false {

        $sql = "
            INSERT INTO customers (
                user_id,
                first_name,
                last_name,
                phone_number
            )
            VALUES (?, ?, ?, ?)
        ";

        $statement = mysqli_prepare(
            $this->connection,
            $sql
        );

        mysqli_stmt_bind_param(
            $statement,
            "isss",
            $userId,
            $firstName,
            $lastName,
            $phoneNumber
        );

        if (!mysqli_stmt_execute($statement)) {
            return false;
        }

        return mysqli_insert_id(
            $this->connection
        );
    }


    public function update(
        int $id,
        string $firstName,
        string $lastName,
        string $phoneNumber
    ): bool {

        $sql = "
            UPDATE customers
            SET
                first_name = ?,
                last_name = ?,
                phone_number = ?
            WHERE id = ?
        ";

        $statement = mysqli_prepare(
            $this->connection,
            $sql
        );

        mysqli_stmt_bind_param(
            $statement,
            "sssi",
            $firstName,
            $lastName,
            $phoneNumber,
            $id
        );

        return mysqli_stmt_execute(
            $statement
        );
    }


    public function delete(int $id): bool
    {
        $sql = "
            DELETE FROM customers
            WHERE id = ?
        ";

        $statement = mysqli_prepare(
            $this->connection,
            $sql
        );

        mysqli_stmt_bind_param(
            $statement,
            "i",
            $id
        );

        return mysqli_stmt_execute(
            $statement
        );
    }


    public function findById(int $id): array|null
    {
        $sql = "
            SELECT *
            FROM customers
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
            $id
        );

        mysqli_stmt_execute($statement);

        $result = mysqli_stmt_get_result(
            $statement
        );

        return mysqli_fetch_assoc($result) ?: null;
    }


    public function findByUserId(
        int $userId
    ): array|null {

        $sql = "
            SELECT *
            FROM customers
            WHERE user_id = ?
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

        $result = mysqli_stmt_get_result(
            $statement
        );

        return mysqli_fetch_assoc($result) ?: null;
    }


    public function getAll(): array
    {
        $sql = "
            SELECT
                c.id,
                c.user_id,
                c.first_name,
                c.last_name,
                c.phone_number,
                u.email
            FROM customers c
            INNER JOIN users u
                ON c.user_id = u.id
            ORDER BY
                c.last_name ASC,
                c.first_name ASC
        ";

        $result = mysqli_query(
            $this->connection,
            $sql
        );

        return mysqli_fetch_all(
            $result,
            MYSQLI_ASSOC
        );
    }

    public function getFullName(int $id): string|null
    {
        $sql = "
        SELECT
            CONCAT(first_name, ' ', last_name) AS full_name
        FROM customers
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
            $id
        );

        mysqli_stmt_execute($statement);

        $result = mysqli_stmt_get_result(
            $statement
        );

        $customer = mysqli_fetch_assoc($result);

        return $customer["full_name"] ?? null;
    }

    public function findWithUser(int $id): array|null
    {
        $sql = "
        SELECT
            c.id,
            c.user_id,
            c.first_name,
            c.last_name,
            c.phone_number,
            u.email,
            u.role_id,
            u.created_at
        FROM customers c
        INNER JOIN users u
            ON c.user_id = u.id
        WHERE c.id = ?
        LIMIT 1
    ";

        $statement = mysqli_prepare(
            $this->connection,
            $sql
        );

        mysqli_stmt_bind_param(
            $statement,
            "i",
            $id
        );

        mysqli_stmt_execute($statement);

        $result = mysqli_stmt_get_result(
            $statement
        );

        return mysqli_fetch_assoc($result) ?: null;
    }

    public function findWithUserId(int $userId): array|null
    {
        $sql = "
        SELECT
            c.id,
            c.user_id,
            c.first_name,
            c.last_name,
            c.phone_number,
            u.email,
            u.role_id,
            u.created_at
        FROM customers c
        INNER JOIN users u
            ON c.user_id = u.id
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

        $result = mysqli_stmt_get_result(
            $statement
        );

        return mysqli_fetch_assoc($result) ?: null;
    }
}
