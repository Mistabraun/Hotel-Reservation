<?php

require_once __DIR__ . "/../../config/Database.php";

require_once __DIR__ . "/../services/PricingService.php";

class Transaction
{
    private mysqli $connection;
    private PricingService $pricing;

    public function __construct()
    {
        $this->connection = Database::connect();
        $this->pricing = new PricingService();
    }

    public function getCurrentBooking(
        int $customerId
    ): ?array {

        $sql = "
             SELECT

                b.secret_key,

                r.id,
                r.booking_reference,
                r.check_in,
                r.check_out,
                r.number_of_guests,
                
                DATEDIFF(r.check_out, r.check_in) AS nights,
                rm.price_per_night * DATEDIFF(r.check_out, r.check_in) AS total_amount,

                rs.name AS reservation_status,

                rm.room_name

            FROM reservations r

            INNER JOIN bookings b
                ON b.reservation_id = r.id

            INNER JOIN reservation_statuses rs
                ON rs.id = r.status_id

            INNER JOIN rooms rm
                ON rm.id = r.room_id

            WHERE
                r.customer_id = ?
                AND rs.name IN ('Pending','Confirmed')

            ORDER BY r.check_in ASC

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

        mysqli_stmt_execute($statement);

        $result = mysqli_fetch_assoc(
            mysqli_stmt_get_result($statement)
        );


        return $result ?: [];
    }

    public function getHistory(
        int $customerId
    ): array {

        $sql = "
            SELECT

            r.booking_reference,

            r.check_in,
            r.check_out,

            DATEDIFF(r.check_out, r.check_in) AS nights,

            (
                rm.price_per_night *
                DATEDIFF(r.check_out, r.check_in)
            ) AS total_amount,

            rm.room_name,

            rs.name AS reservation_status

        FROM reservations r

        INNER JOIN rooms rm
            ON rm.id = r.room_id

        INNER JOIN reservation_statuses rs
            ON rs.id = r.status_id

                WHERE
                r.customer_id = ?

            ORDER BY r.check_in DESC
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

        mysqli_stmt_execute($statement);

        $result = mysqli_stmt_get_result($statement);

        $history = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $history[] = $row;
        }

        return $history;
    }
}
