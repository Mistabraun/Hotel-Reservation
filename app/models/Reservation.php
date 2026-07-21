<?php

require_once __DIR__ . "/../../config/Database.php";

class Reservation
{
    private mysqli $connection;

    public function __construct()
    {
        $this->connection = Database::connect();
    }

    public function create(
        string $bookingReference,
        int $customerId,
        int $roomId,
        string $checkIn,
        string $checkOut,
        int $guestCount,
        float $totalAmount,
        int $statusId
    ): int|false {

        $sql = "
            INSERT INTO reservations (
                booking_reference,
                customer_id,
                room_id,
                check_in,
                check_out,
                guest_count,
                total_amount,
                status_id
            )
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ";

        $statement = mysqli_prepare(
            $this->connection,
            $sql
        );

        mysqli_stmt_bind_param(
            $statement,
            "siissidi",
            $bookingReference,
            $customerId,
            $roomId,
            $checkIn,
            $checkOut,
            $guestCount,
            $totalAmount,
            $statusId
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
        int $roomId,
        string $checkIn,
        string $checkOut,
        int $guestCount,
        float $totalAmount,
        int $statusId
    ): bool {

        $sql = "
            UPDATE reservations
            SET
                room_id = ?,
                check_in = ?,
                check_out = ?,
                guest_count = ?,
                total_amount = ?,
                status_id = ?
            WHERE id = ?
        ";

        $statement = mysqli_prepare(
            $this->connection,
            $sql
        );

        mysqli_stmt_bind_param(
            $statement,
            "issidii",
            $roomId,
            $checkIn,
            $checkOut,
            $guestCount,
            $totalAmount,
            $statusId,
            $id
        );

        return mysqli_stmt_execute(
            $statement
        );
    }

    public function updateStatus(
        int $id,
        int $statusId
    ): bool {

        $sql = "
            UPDATE reservations
            SET status_id = ?
            WHERE id = ?
        ";

        $statement = mysqli_prepare(
            $this->connection,
            $sql
        );

        mysqli_stmt_bind_param(
            $statement,
            "ii",
            $statusId,
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
            DELETE FROM reservations
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
                r.*,
                rs.name AS status,
                rm.room_name,
                rm.room_number,
                rt.name AS room_type,
                c.first_name,
                c.last_name,
                u.email
            FROM reservations r
            INNER JOIN reservation_statuses rs
                ON r.status_id = rs.id
            INNER JOIN rooms rm
                ON r.room_id = rm.id
            INNER JOIN room_types rt
                ON rm.room_type_id = rt.id
            INNER JOIN customers c
                ON r.customer_id = c.id
            INNER JOIN users u
                ON c.user_id = u.id
            WHERE r.id = ?
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

    public function findByBookingReference(
        string $reference
    ): array|null {

        $sql = "
            SELECT *
            FROM reservations
            WHERE booking_reference = ?
            LIMIT 1
        ";

        $statement = mysqli_prepare(
            $this->connection,
            $sql
        );

        mysqli_stmt_bind_param(
            $statement,
            "s",
            $reference
        );

        mysqli_stmt_execute($statement);

        $result = mysqli_stmt_get_result(
            $statement
        );

        return mysqli_fetch_assoc($result) ?: null;
    }

    public function getAll(
        QueryOptions $options
    ): array {

        $sql = "
            SELECT
                r.id,
                r.booking_reference,
                CONCAT(c.first_name, ' ', c.last_name) AS guest,
                u.email,
                rm.room_name,
                rt.name AS room_type,
                r.check_in,
                r.check_out,
                r.guest_count,
                r.total_amount,
                rs.name AS status
            FROM reservations r
            INNER JOIN customers c
                ON r.customer_id = c.id
            INNER JOIN users u
                ON c.user_id = u.id
            INNER JOIN rooms rm
                ON r.room_id = rm.id
            INNER JOIN room_types rt
                ON rm.room_type_id = rt.id
            INNER JOIN reservation_statuses rs
                ON r.status_id = rs.id
            WHERE 1 = 1
        ";

        $types = "";
        $params = [];

        if (strtolower($options->filter) !== "all") {

            $sql .= " AND LOWER(rs.name) = ?";

            $types .= "s";
            $params[] = strtolower($options->filter);
        }

        if ($options->search !== "") {

            $sql .= "
                AND (
                    r.booking_reference LIKE ?
                    OR c.first_name LIKE ?
                    OR c.last_name LIKE ?
                    OR rm.room_name LIKE ?
                    OR rm.room_number LIKE ?
                )
            ";

            $keyword = "%{$options->search}%";

            $types .= "sssss";

            for ($i = 0; $i < 5; $i++) {
                $params[] = $keyword;
            }
        }

        $sql .= "
            ORDER BY r.id DESC
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

        $result = mysqli_stmt_get_result(
            $statement
        );

        return mysqli_fetch_all(
            $result,
            MYSQLI_ASSOC
        );
    }

    public function count(
        QueryOptions $options
    ): int {

        $sql = "
            SELECT COUNT(*) AS total
            FROM reservations r
            INNER JOIN customers c
                ON r.customer_id = c.id
            INNER JOIN rooms rm
                ON r.room_id = rm.id
            INNER JOIN reservation_statuses rs
                ON r.status_id = rs.id
            WHERE 1 = 1
        ";

        $types = "";
        $params = [];

        if (strtolower($options->filter) !== "all") {

            $sql .= " AND LOWER(rs.name) = ?";

            $types .= "s";
            $params[] = strtolower($options->filter);
        }

        if ($options->search !== "") {

            $sql .= "
                AND (
                    r.booking_reference LIKE ?
                    OR c.first_name LIKE ?
                    OR c.last_name LIKE ?
                    OR rm.room_name LIKE ?
                    OR rm.room_number LIKE ?
                )
            ";

            $keyword = "%{$options->search}%";

            $types .= "sssss";

            for ($i = 0; $i < 5; $i++) {
                $params[] = $keyword;
            }
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

        $result = mysqli_stmt_get_result(
            $statement
        );

        return (int) mysqli_fetch_assoc($result)["total"];
    }

    public function countAll(): int
    {
        $sql = "
        SELECT COUNT(*) AS total
        FROM reservations
    ";

        $result = mysqli_query(
            $this->connection,
            $sql
        );

        return (int)mysqli_fetch_assoc($result)["total"];
    }
}
