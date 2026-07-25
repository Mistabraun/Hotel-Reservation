<?php

require_once __DIR__ . "/../../config/Database.php";

class Booking
{
    private mysqli $connection;

    public function __construct()
    {
        $this->connection = Database::connect();
    }

    public function create(
        int $reservationId,
        string $secretKey,
        ?string $expiresAt = null
    ): int {

        $sql = "
            INSERT INTO bookings (
                reservation_id,
                secret_key,
                expires_at
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
            $reservationId,
            $secretKey,
            $expiresAt
        );

        mysqli_stmt_execute($statement);

        return mysqli_insert_id(
            $this->connection
        );
    }

    public function findByReservationId(
        int $reservationId
    ): ?array {

        $sql = "
            SELECT *
            FROM bookings
            WHERE reservation_id = ?
            LIMIT 1
        ";

        $statement = mysqli_prepare(
            $this->connection,
            $sql
        );

        mysqli_stmt_bind_param(
            $statement,
            "i",
            $reservationId
        );

        mysqli_stmt_execute(
            $statement
        );

        $result = mysqli_stmt_get_result(
            $statement
        );

        return mysqli_fetch_assoc($result) ?: null;
    }

    public function findBySecretKey(
        string $secretKey
    ): ?array {

        $sql = "
            SELECT *
            FROM bookings
            WHERE secret_key = ?
            LIMIT 1
        ";

        $statement = mysqli_prepare(
            $this->connection,
            $sql
        );

        mysqli_stmt_bind_param(
            $statement,
            "s",
            $secretKey
        );

        mysqli_stmt_execute(
            $statement
        );

        $result = mysqli_stmt_get_result(
            $statement
        );

        return mysqli_fetch_assoc($result) ?: null;
    }

    public function viewBySecretKey(
        string $secretKey
    ): ?array {

        $sql = "
        SELECT

            rs.name AS reservation_status,
            r.id AS reservation_id,
            rm.room_name,
            r.booking_reference AS reference,
            p.id AS payment_id,
            rt.name AS room_type,
            ps.name AS payment_status

        FROM bookings b

        INNER JOIN reservations r
            ON b.reservation_id = r.id

        INNER JOIN reservation_statuses rs
            ON r.status_id = rs.id

        INNER JOIN rooms rm
            ON r.room_id = rm.id

        INNER JOIN room_types rt
            ON rm.room_type_id = rt.id

        LEFT JOIN payments p
            ON p.reservation_id = r.id

        LEFT JOIN payment_methods pm
            ON p.payment_method_id = pm.id

        LEFT JOIN payment_statuses ps
            ON p.status_id = ps.id

        WHERE b.secret_key = ?

        LIMIT 1
    ";

        $statement = mysqli_prepare(
            $this->connection,
            $sql
        );

        mysqli_stmt_bind_param(
            $statement,
            "s",
            $secretKey
        );

        mysqli_stmt_execute(
            $statement
        );

        $result = mysqli_stmt_get_result(
            $statement
        );

        return mysqli_fetch_assoc($result) ?: null;
    }



    public function deleteBySecretKey(
        string $secretKey
    ): bool {

        $sql = "
        DELETE
        FROM bookings
        WHERE secret_key = ?
    ";

        $statement = mysqli_prepare(
            $this->connection,
            $sql
        );

        mysqli_stmt_bind_param(
            $statement,
            "s",
            $secretKey
        );

        return mysqli_stmt_execute(
            $statement
        );
    }
}
