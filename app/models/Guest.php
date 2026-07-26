<?php
require_once __DIR__ . "/../../config/Database.php";

class Guest
{
    private mysqli $connection;

    public function __construct()
    {
        $this->connection = Database::connect();
    }


    public function getGuests(
        array $filters = []
    ): array {

        $sql = "
            SELECT

                c.id,

                c.first_name,
                c.last_name,

                CONCAT(
                    c.first_name,
                    ' ',
                    c.last_name
                ) AS full_name,

                u.email,
                c.phone_number,

                u.created_at AS member_since,

                (
                    SELECT COUNT(*)
                    FROM reservations r
                    INNER JOIN reservation_statuses rs
                        ON rs.id = r.status_id
                    WHERE
                        r.customer_id = c.id
                        AND rs.name = 'Completed'
                ) AS total_stays,

                (
                    SELECT MAX(r.check_out)
                    FROM reservations r
                    INNER JOIN reservation_statuses rs
                        ON rs.id = r.status_id
                    WHERE
                        r.customer_id = c.id
                        AND rs.name = 'Completed'
                ) AS last_stay

            FROM customers c

            INNER JOIN users u
                ON u.id = c.user_id

            ORDER BY
                c.first_name,
                c.last_name
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

    public function getGuestById(
        int $customerId
    ): ?array {

        $sql = "
            SELECT

                c.id,

                c.first_name,
                c.last_name,

                CONCAT(
                    c.first_name,
                    ' ',
                    c.last_name
                ) AS full_name,

                u.email,
                c.phone_number,
                

                u.created_at AS member_since,

                (
                    SELECT COUNT(*)
                    FROM reservations r
                    INNER JOIN reservation_statuses rs
                        ON rs.id = r.status_id
                    WHERE
                        r.customer_id = c.id
                        AND rs.name = 'Completed'
                ) AS total_stays,

                (
                    SELECT MAX(r.check_out)
                    FROM reservations r
                    INNER JOIN reservation_statuses rs
                        ON rs.id = r.status_id
                    WHERE
                        r.customer_id = c.id
                        AND rs.name = 'Completed'
                ) AS last_stay

            FROM customers c

            INNER JOIN users u
                ON u.id = c.user_id

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
            $customerId
        );

        mysqli_stmt_execute(
            $statement
        );

        $result = mysqli_stmt_get_result(
            $statement
        );

        $guest = mysqli_fetch_assoc(
            $result
        );

        return $guest ?: null;
    }
    public function getSummary(): array
    {
        $sql = "
        SELECT

            (
                SELECT COUNT(*)
                FROM customers
            ) AS total_guests,

            (
                SELECT COUNT(*)
                FROM reservations r
                INNER JOIN reservation_statuses rs
                    ON rs.id = r.status_id
                WHERE rs.name = 'Completed'
            ) AS total_stays,

            (
                SELECT COUNT(*)
                FROM (
                    SELECT
                        customer_id
                    FROM reservations r
                    INNER JOIN reservation_statuses rs
                        ON rs.id = r.status_id
                    WHERE rs.name = 'Completed'
                    GROUP BY customer_id
                    HAVING COUNT(*) > 1
                ) repeat_guests
            ) AS repeat_guests,

            (
                SELECT COUNT(*)
                FROM (
                    SELECT
                        customer_id
                    FROM reservations r
                    INNER JOIN reservation_statuses rs
                        ON rs.id = r.status_id
                    WHERE rs.name = 'Completed'
                    GROUP BY customer_id
                    HAVING COUNT(*) = 1
                ) new_guests
            ) AS new_guests
    ";

        $result = mysqli_query(
            $this->connection,
            $sql
        );

        return mysqli_fetch_assoc($result);
    }
    
    public function getReservationHistory(
        int $customerId
    ): array {

        $sql = "
            SELECT

                r.id,

                r.booking_reference,

                r.check_in,
                r.check_out,

                r.number_of_guests,

      DATEDIFF(r.check_out, r.check_in) AS nights,

    GREATEST(
        r.number_of_guests - rm.capacity,
        0
    ) * 250 AS extra_guest_fee,

    (
        rm.price_per_night +

        (
            GREATEST(
                r.number_of_guests - rm.capacity,
                0
            ) * 250
        )

    ) * DATEDIFF(
        r.check_out,
        r.check_in
    ) AS total_amount,
                rs.name AS status,

                rm.room_name

            FROM reservations r

            INNER JOIN reservation_statuses rs
                ON rs.id = r.status_id

            INNER JOIN rooms rm
                ON rm.id = r.room_id

            WHERE
                r.customer_id = ?

            ORDER BY
                r.check_in DESC
        ";

        $statement = mysqli_prepare(
            $this->connection,
            $sql
        );

        mysqli_stmt_bind_param(
            $statement,
            "i",
            $customerId
        );

        mysqli_stmt_execute(
            $statement
        );

        $result = mysqli_stmt_get_result(
            $statement
        );

        return mysqli_fetch_all(
            $result,
            MYSQLI_ASSOC
        );
    }
}
