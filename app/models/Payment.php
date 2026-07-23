<?php

require_once __DIR__ . "/../../config/Database.php";

class Payment
{
    private mysqli $connection;

    public function __construct()
    {
        $this->connection = Database::connect();
    }

    public function countAll(): int
    {
        $result = mysqli_query(
            $this->connection,
            "SELECT COUNT(*) AS total FROM payments"
        );

        return (int) mysqli_fetch_assoc($result)["total"];
    }

    public function getAll(QueryOptions $options): array
    {
        $sql = "
            SELECT
                p.id,
                p.payment_reference,
                p.amount,
                p.transaction_reference,
                p.paid_at,
                p.created_at,

                r.booking_reference,

                CONCAT(c.first_name, ' ', c.last_name) AS guest,

                pm.name AS payment_method,
                ps.name AS status

            FROM payments p

            INNER JOIN reservations r
                ON p.reservation_id = r.id

            INNER JOIN customers c
                ON r.customer_id = c.id

            INNER JOIN payment_methods pm
                ON p.payment_method_id = pm.id

            INNER JOIN payment_statuses ps
                ON p.status_id = ps.id

            WHERE 1=1
        ";

        $types = "";
        $params = [];

        if (strtolower($options->filter) !== "all") {

            $sql .= " AND LOWER(ps.name) = ?";

            $types .= "s";
            $params[] = strtolower($options->filter);
        }

        if ($options->search !== "") {

            $sql .= "
                AND (
                    p.payment_reference LIKE ?
                    OR r.booking_reference LIKE ?
                    OR CONCAT(c.first_name, ' ', c.last_name) LIKE ?
                )
            ";

            $keyword = "%{$options->search}%";

            $types .= "sss";

            $params[] = $keyword;
            $params[] = $keyword;
            $params[] = $keyword;
        }

        $sql .= "
            ORDER BY p.created_at DESC
            LIMIT ?, ?
        ";

        $types .= "ii";

        $params[] = $options->offset;
        $params[] = $options->limit;

        $statement = mysqli_prepare(
            $this->connection,
            $sql
        );

        mysqli_stmt_bind_param(
            $statement,
            $types,
            ...$params
        );

        mysqli_stmt_execute($statement);

        $result = mysqli_stmt_get_result($statement);

        return mysqli_fetch_all(
            $result,
            MYSQLI_ASSOC
        );
    }

    public function count(QueryOptions $options): int
    {
        $sql = "
            SELECT COUNT(*) AS total

            FROM payments p

            INNER JOIN reservations r
                ON p.reservation_id = r.id

            INNER JOIN customers c
                ON r.customer_id = c.id

            INNER JOIN payment_statuses ps
                ON p.status_id = ps.id

            WHERE 1=1
        ";

        $types = "";
        $params = [];

        if (strtolower($options->filter) !== "all") {

            $sql .= " AND LOWER(ps.name) = ?";

            $types .= "s";
            $params[] = strtolower($options->filter);
        }

        if ($options->search !== "") {

            $sql .= "
                AND (
                    p.payment_reference LIKE ?
                    OR r.booking_reference LIKE ?
                    OR CONCAT(c.first_name, ' ', c.last_name) LIKE ?
                )
            ";

            $keyword = "%{$options->search}%";

            $types .= "sss";

            $params[] = $keyword;
            $params[] = $keyword;
            $params[] = $keyword;
        }

        $statement = mysqli_prepare(
            $this->connection,
            $sql
        );

        if (!empty($params)) {

            mysqli_stmt_bind_param(
                $statement,
                $types,
                ...$params
            );
        }

        mysqli_stmt_execute($statement);

        $result = mysqli_stmt_get_result($statement);

        return (int) mysqli_fetch_assoc($result)["total"];
    }

    public function findByReservationId(
        int $reservationId
    ): ?array {

        $statement = mysqli_prepare(
            $this->connection,
            "
            SELECT *
            FROM payments
            WHERE reservation_id = ?
            LIMIT 1
        "
        );

        mysqli_stmt_bind_param(
            $statement,
            "i",
            $reservationId
        );

        mysqli_stmt_execute($statement);

        $result = mysqli_stmt_get_result($statement);

        return mysqli_fetch_assoc($result) ?: null;
    }

    public function findById(int $id): ?array
    {
        $statement = mysqli_prepare(
            $this->connection,
            "
                SELECT *
                FROM payments
                WHERE id = ?
            "
        );

        mysqli_stmt_bind_param(
            $statement,
            "i",
            $id
        );

        mysqli_stmt_execute($statement);

        $result = mysqli_stmt_get_result($statement);

        return mysqli_fetch_assoc($result) ?: null;
    }

    public function getAvailableReservations(): array
    {
        $statement = mysqli_prepare(
            $this->connection,
            "
        SELECT
            r.id,
            r.booking_reference,
            CONCAT(
                c.first_name,
                ' ',
                c.last_name
            ) AS guest,
            rm.price_per_night,
            DATEDIFF(r.check_out, r.check_in) AS nights,
            rm.price_per_night * DATEDIFF(r.check_out, r.check_in) AS total_amount
        FROM reservations r
        INNER JOIN customers c
            ON r.customer_id = c.id
        INNER JOIN rooms rm
            ON r.room_id = rm.id
        LEFT JOIN payments p
            ON p.reservation_id = r.id
        WHERE p.id IS NULL
        ORDER BY r.booking_reference ASC
        "
        );

        mysqli_stmt_execute($statement);

        $result = mysqli_stmt_get_result($statement);

        return mysqli_fetch_all(
            $result,
            MYSQLI_ASSOC
        );
    }

    public function updateStatus(
        int $id,
        int $statusId,
        ?string $paidAt = null
    ): bool {

        $statement = mysqli_prepare(
            $this->connection,
            "
            UPDATE payments
            SET
                status_id = ?,
                paid_at = ?
            WHERE id = ?
        "
        );

        mysqli_stmt_bind_param(
            $statement,
            "isi",
            $statusId,
            $paidAt,
            $id
        );

        return mysqli_stmt_execute($statement);
    }

    public function create(
        string $paymentReference,
        int $reservationId,
        int $paymentMethodId,
        int $statusId,
        float $amount,
        ?string $transactionReference = null,
        ?string $paidAt = null
    ): int|false {

        $statement = mysqli_prepare(
            $this->connection,
            "
                INSERT INTO payments (
                    payment_reference,
                    reservation_id,
                    payment_method_id,
                    status_id,
                    amount,
                    transaction_reference,
                    paid_at
                )
                VALUES (?, ?, ?, ?, ?, ?, ?)
            "
        );

        mysqli_stmt_bind_param(
            $statement,
            "siiidss",
            $paymentReference,
            $reservationId,
            $paymentMethodId,
            $statusId,
            $amount,
            $transactionReference,
            $paidAt
        );

        if (!mysqli_stmt_execute($statement)) {
            return false;
        }

        return mysqli_insert_id($this->connection);
    }

    public function update(
        int $id,
        int $paymentMethodId,
        int $statusId,
        float $amount,
        ?string $transactionReference,
        ?string $paidAt
    ): bool {

        $statement = mysqli_prepare(
            $this->connection,
            "
                UPDATE payments
                SET
                    payment_method_id = ?,
                    status_id = ?,
                    amount = ?,
                    transaction_reference = ?,
                    paid_at = ?
                WHERE id = ?
            "
        );

        mysqli_stmt_bind_param(
            $statement,
            "iidssi",
            $paymentMethodId,
            $statusId,
            $amount,
            $transactionReference,
            $paidAt,
            $id
        );

        return mysqli_stmt_execute($statement);
    }

    public function delete(int $id): bool
    {
        $statement = mysqli_prepare(
            $this->connection,
            "
                DELETE
                FROM payments
                WHERE id = ?
            "
        );

        mysqli_stmt_bind_param(
            $statement,
            "i",
            $id
        );

        return mysqli_stmt_execute($statement);
    }

    public function countByStatus(string $status): int
    {
        $statement = mysqli_prepare(
            $this->connection,
            "
                SELECT COUNT(*) AS total
                FROM payments p
                INNER JOIN payment_statuses ps
                    ON p.status_id = ps.id
                WHERE LOWER(ps.name) = LOWER(?)
            "
        );

        mysqli_stmt_bind_param(
            $statement,
            "s",
            $status
        );

        mysqli_stmt_execute($statement);

        $result = mysqli_stmt_get_result($statement);

        return (int) mysqli_fetch_assoc($result)["total"];
    }

    public function getPaymentMethods(): array
    {
        $result = mysqli_query(
            $this->connection,
            "
            SELECT
                id,
                name
            FROM payment_methods
            ORDER BY name ASC
        "
        );

        return mysqli_fetch_all(
            $result,
            MYSQLI_ASSOC
        );
    }
}
