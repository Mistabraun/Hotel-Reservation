<?php
require_once __DIR__ . "/../../config/Database.php";

class User
{
    private mysqli $connection;

    public function __construct()
    {
        $this->connection = Database::connect();
    }

    public function create(
        string $email,
        string $password,
        int $roleId
    ): int|false {

        $sql = "
            INSERT INTO users (
                email,
                password,
                role_id
            )
            VALUES (?, ?, ?)
        ";

        $statement = mysqli_prepare(
            $this->connection,
            $sql
        );

        mysqli_stmt_bind_param(
            $statement,
            "ssi",
            $email,
            $password,
            $roleId
        );

        if (!mysqli_stmt_execute($statement)) {
            return false;
        }

        return mysqli_insert_id(
            $this->connection
        );
    }

    public function updateEmail(
        int $id,
        string $email
    ): bool {

        $sql = "
            UPDATE users
            SET email = ?
            WHERE id = ?
        ";

        $statement = mysqli_prepare(
            $this->connection,
            $sql
        );

        mysqli_stmt_bind_param(
            $statement,
            "si",
            $email,
            $id
        );

        return mysqli_stmt_execute(
            $statement
        );
    }

    public function updatePassword(
        int $id,
        string $password
    ): bool {

        $sql = "
            UPDATE users
            SET password = ?
            WHERE id = ?
        ";

        $statement = mysqli_prepare(
            $this->connection,
            $sql
        );

        mysqli_stmt_bind_param(
            $statement,
            "si",
            $password,
            $id
        );

        return mysqli_stmt_execute(
            $statement
        );
    }

    public function delete(
        int $id
    ): bool {

        $sql = "
            DELETE FROM users
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

    public function findById(
        int $id
    ): array|null {

        $sql = "
            SELECT
                u.id,
                u.email,
                u.password,
                u.role_id
            FROM users u
            WHERE u.id = ?
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

    public function findByEmail(
        string $email
    ): array|null {

        $sql = "
            SELECT
                u.id,
                u.email,
                u.password,
                u.role_id
            FROM users u
            WHERE u.email = ?
            LIMIT 1
        ";

        $statement = mysqli_prepare(
            $this->connection,
            $sql
        );

        mysqli_stmt_bind_param(
            $statement,
            "s",
            $email
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
                u.id,
                u.email,
                u.role_id
                u.created_at
            FROM users u
            ORDER BY u.created_at DESC
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
}
