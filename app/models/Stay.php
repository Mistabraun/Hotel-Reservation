<?php
require_once __DIR__ . "/../../config/Database.php";
require_once __DIR__ . "/../helper/QueryOptions.php";

class Stay
{
    private mysqli $connection;

    public function __construct()
    {
        $this->connection = Database::connect();
    }

    public function create(
        int $reservationId
    ): bool {

        $sql = "
            INSERT INTO stays (
                reservation_id,
                checked_in_at
            )
            VALUES (?, NOW())
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

        return mysqli_stmt_execute($statement);
    }


    public function checkOut(
        int $reservationId
    ): bool {

        $sql = "
            UPDATE stays
            SET checked_out_at = NOW()
            WHERE reservation_id = ?
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

        return mysqli_stmt_execute($statement);
    }


    public function findByReservationId(
        int $reservationId
    ): ?array {

        $sql = "
            SELECT *
            FROM stays
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

        mysqli_stmt_execute($statement);

        $result = mysqli_stmt_get_result($statement);

        return mysqli_fetch_assoc($result) ?: null;
    }


    public function isCheckedIn(
        int $reservationId
    ): bool {

        $sql = "
            SELECT id
            FROM stays
            WHERE reservation_id = ?
            AND checked_out_at IS NULL
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

        mysqli_stmt_execute($statement);

        $result = mysqli_stmt_get_result($statement);

        return mysqli_num_rows($result) > 0;
    }


    public function getTodayArrivals(
        QueryOptions $options
    ): array {

        $sql = "
            SELECT
                r.id,
                r.booking_reference,
                CONCAT(c.first_name, ' ', c.last_name) AS guest,
                rm.room_name,
                r.check_in,
                r.check_out,
                r.number_of_guests
            FROM reservations r

            INNER JOIN customers c
                ON r.customer_id = c.id

            INNER JOIN rooms rm
                ON r.room_id = rm.id

            LEFT JOIN stays s
                ON r.id = s.reservation_id

            WHERE
                r.check_in = CURDATE()
                AND s.id IS NULL

            ORDER BY r.check_in ASC

            LIMIT ?, ?
        ";

        $statement = mysqli_prepare(
            $this->connection,
            $sql
        );

        mysqli_stmt_bind_param(
            $statement,
            "ii",
            $options->offset,
            $options->limit
        );

        mysqli_stmt_execute($statement);

        $result = mysqli_stmt_get_result($statement);

        return mysqli_fetch_all(
            $result,
            MYSQLI_ASSOC
        );
    }


    public function countTodayArrivals(): int
    {

        $sql = "
            SELECT COUNT(*) AS total
            FROM reservations r

            LEFT JOIN stays s
                ON r.id = s.reservation_id

            WHERE
                r.check_in = CURDATE()
                AND s.id IS NULL
        ";

        $result = mysqli_query(
            $this->connection,
            $sql
        );

        return (int)mysqli_fetch_assoc($result)["total"];
    }


    public function getCurrentGuests(
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
            r.number_of_guests,
            s.checked_in_at

        FROM stays s

        INNER JOIN reservations r
            ON s.reservation_id = r.id

        INNER JOIN customers c
            ON r.customer_id = c.id

        INNER JOIN users u
            ON c.user_id = u.id

        INNER JOIN rooms rm
            ON r.room_id = rm.id

        INNER JOIN room_types rt
            ON rm.room_type_id = rt.id

        WHERE
            s.checked_in_at IS NOT NULL
            AND s.checked_out_at IS NULL
            AND CURDATE() BETWEEN r.check_in AND r.check_out

        ORDER BY
            r.check_out ASC,
            s.checked_in_at ASC

        LIMIT ?, ?
    ";

        $statement = mysqli_prepare(
            $this->connection,
            $sql
        );

        mysqli_stmt_bind_param(
            $statement,
            "ii",
            $options->offset,
            $options->limit
        );

        mysqli_stmt_execute($statement);

        $result = mysqli_stmt_get_result($statement);

        return mysqli_fetch_all(
            $result,
            MYSQLI_ASSOC
        );
    }


    public function countCurrentGuests(): int
    {
        $sql = "
        SELECT COUNT(*) AS total

        FROM stays s

        INNER JOIN reservations r
            ON s.reservation_id = r.id

        WHERE
            s.checked_in_at IS NOT NULL
            AND s.checked_out_at IS NULL
            AND CURDATE() BETWEEN r.check_in AND r.check_out
    ";

        $result = mysqli_query(
            $this->connection,
            $sql
        );

        return (int) mysqli_fetch_assoc($result)["total"];
    }


    public function getCheckedOut(
        QueryOptions $options
    ): array {

        $sql = "
            SELECT
                r.id,
                r.booking_reference,
                CONCAT(c.first_name, ' ', c.last_name) AS guest,
                rm.room_name,
                s.checked_in_at,
                s.checked_out_at
            FROM stays s

            INNER JOIN reservations r
                ON s.reservation_id = r.id

            INNER JOIN customers c
                ON r.customer_id = c.id

            INNER JOIN rooms rm
                ON r.room_id = rm.id

            WHERE
                s.checked_out_at IS NOT NULL

            ORDER BY s.checked_out_at DESC

            LIMIT ?, ?
        ";

        $statement = mysqli_prepare(
            $this->connection,
            $sql
        );

        mysqli_stmt_bind_param(
            $statement,
            "ii",
            $options->offset,
            $options->limit
        );

        mysqli_stmt_execute($statement);

        $result = mysqli_stmt_get_result($statement);

        return mysqli_fetch_all(
            $result,
            MYSQLI_ASSOC
        );
    }


    public function countCheckedOut(): int
    {

        $sql = "
            SELECT COUNT(*) AS total
            FROM stays
            WHERE checked_out_at IS NOT NULL
        ";

        $result = mysqli_query(
            $this->connection,
            $sql
        );

        return (int)mysqli_fetch_assoc($result)["total"];
    }
}
