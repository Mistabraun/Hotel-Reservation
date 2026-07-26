<?php

require_once __DIR__ . "/../../config/Database.php";

class Reservation
{
    private mysqli $connection;

    public function __construct()
    {
        $this->connection = Database::connect();
    }

    public function getNextReferenceNumber(): int
    {
        $sql = "
        SELECT COALESCE(MAX(id), 0) + 1 AS next_number
        FROM reservations
    ";

        $result = mysqli_query($this->connection, $sql);

        return (int) mysqli_fetch_assoc($result)["next_number"];
    }



    public function create(
        string $bookingReference,
        int $customerId,
        int $roomId,
        string $checkIn,
        string $checkOut,
        int $guestCount,
        int $statusId,
        ?string $requests = ""
    ): int|false {

        $sql = "
            INSERT INTO reservations (
                booking_reference,
                customer_id,
                room_id,
                check_in,
                check_out,
                number_of_guests,
                status_id,
                requests
            )
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ";

        $statement = mysqli_prepare(
            $this->connection,
            $sql
        );

        mysqli_stmt_bind_param(
            $statement,
            "siissiis",
            $bookingReference,
            $customerId,
            $roomId,
            $checkIn,
            $checkOut,
            $guestCount,
            $statusId,
            $requests
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
        int $statusId,
        ?string $requests = ""
    ): bool {

        $sql = "
            UPDATE reservations
            SET
                room_id = ?,
                check_in = ?,
                check_out = ?,
                number_of_guests = ?,
                status_id = ?,
                requests = ?
            WHERE id = ?
        ";

        $statement = mysqli_prepare(
            $this->connection,
            $sql
        );

        mysqli_stmt_bind_param(
            $statement,
            "issiisi",
            $roomId,
            $checkIn,
            $checkOut,
            $guestCount,
            $statusId,
            $requests,
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

    public function hasConflictingReservation(
        int $roomId,
        string $checkIn,
        string $checkOut,
        ?int $excludeReservationId = null
    ): bool {

        $sql = "
        SELECT COUNT(*) AS total
        FROM reservations r

        INNER JOIN reservation_statuses rs
            ON r.status_id = rs.id

        WHERE
            r.room_id = ?
            AND LOWER(rs.name) <> 'cancelled'
            AND ? < r.check_out
            AND ? > r.check_in
    ";

        $types = "iss";
        $params = [
            $roomId,
            $checkIn,
            $checkOut
        ];

        if ($excludeReservationId !== null) {

            $sql .= " AND r.id <> ?";

            $types .= "i";
            $params[] = $excludeReservationId;
        }

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

        return (int) mysqli_fetch_assoc($result)["total"] > 0;
    }

    public function findById(
        int $id
    ): array|null {

        $sql = "
            SELECT
                r.booking_reference,
                 CONCAT(c.first_name, ' ', c.last_name) AS guest,
                 c.first_name, 
                 c.last_name,
                 c.phone_number,
                u.email,
                rm.room_name,
                rm.id AS room_id,
                rm.price_per_night,
                rm.capacity,
                DATEDIFF(r.check_out, r.check_in) AS nights,
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
                rt.name AS room_type,
                r.check_in,
                r.check_out,
                r.number_of_guests,
                rs.id AS status
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

    public function getUnavailableDates(int $roomId, ?int $reservationId = null): array
    {
        $sql = "
        SELECT
            check_in AS `from`,
            DATE_SUB(check_out, INTERVAL 1 DAY) AS `to`

        FROM reservations r

        INNER JOIN reservation_statuses rs
            ON r.status_id = rs.id

        WHERE
            r.room_id = ? ";

        $params = [$roomId];
        $types = "s";

        if ($reservationId) {
            $sql .= "AND r.id <> ? ";
            $types .= "s";
            $params[] = $reservationId;
        }

        $sql .= "AND LOWER(rs.name) <> 'cancelled'
        AND check_out >= CURDATE()
        ORDER BY check_in ASC
        ";



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

        $ranges = [];

        while ($row = mysqli_fetch_assoc($result)) {

            $ranges[] = [
                "from" => $row["from"],
                "to"   => $row["to"]
            ];
        }

        return $ranges;
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
                rm.id AS room_id,
                rm.price_per_night,
                rm.capacity,
                DATEDIFF(r.check_out, r.check_in) AS nights,
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
                rt.name AS room_type,
                r.check_in,
                r.check_out,
                r.number_of_guests,
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
                    WHERE 1=1

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

    public function countByStatus(string $status): int
    {
        $sql = "
        SELECT COUNT(*) AS total
        FROM reservations r
        INNER JOIN reservation_statuses rs
            ON r.status_id = rs.id
        WHERE LOWER(rs.name) = LOWER(?)
    ";

        $statement = mysqli_prepare($this->connection, $sql);

        mysqli_stmt_bind_param(
            $statement,
            "s",
            $status
        );

        mysqli_stmt_execute($statement);

        $result = mysqli_stmt_get_result($statement);

        return (int) mysqli_fetch_assoc($result)["total"];
    }
}
