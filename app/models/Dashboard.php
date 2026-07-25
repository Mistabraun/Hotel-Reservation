<?php

require_once __DIR__ . "/../../config/Database.php";

class Dashboard
{
    private mysqli $connection;

    public function __construct()
    {
        $this->connection = Database::connect();
    }

    public function getWeeklyOccupancy(): array
    {
        $sql = "
        SELECT
            DAYOFWEEK(d.day) AS weekday,
            COUNT(DISTINCT r.room_id) AS occupied

        FROM (
            SELECT CURDATE() - INTERVAL WEEKDAY(CURDATE()) DAY AS day
            UNION ALL
            SELECT CURDATE() - INTERVAL WEEKDAY(CURDATE()) DAY + INTERVAL 1 DAY
            UNION ALL
            SELECT CURDATE() - INTERVAL WEEKDAY(CURDATE()) DAY + INTERVAL 2 DAY
            UNION ALL
            SELECT CURDATE() - INTERVAL WEEKDAY(CURDATE()) DAY + INTERVAL 3 DAY
            UNION ALL
            SELECT CURDATE() - INTERVAL WEEKDAY(CURDATE()) DAY + INTERVAL 4 DAY
            UNION ALL
            SELECT CURDATE() - INTERVAL WEEKDAY(CURDATE()) DAY + INTERVAL 5 DAY
            UNION ALL
            SELECT CURDATE() - INTERVAL WEEKDAY(CURDATE()) DAY + INTERVAL 6 DAY
        ) d

        LEFT JOIN reservations r
            ON d.day >= r.check_in
            AND d.day < r.check_out

        GROUP BY d.day
        ORDER BY d.day
    ";

        $result = mysqli_query($this->connection, $sql);

        $data = array_fill(0, 7, 0);

        while ($row = mysqli_fetch_assoc($result)) {

            $index = (int)$row["weekday"] - 2;

            if ($index < 0) {
                $index = 6;
            }

            $data[$index] = (int)$row["occupied"];
        }

        return [
            "labels" => [
                "Mon",
                "Tue",
                "Wed",
                "Thu",
                "Fri",
                "Sat",
                "Sun"
            ],
            "data" => $data
        ];
    }

    public function getMonthlyRevenueChart(): array
    {
        $sql = "
        SELECT
            MONTH(p.paid_at) AS month,
            COALESCE(SUM(p.amount), 0) AS revenue

        FROM payments p

        INNER JOIN payment_statuses ps
            ON p.status_id = ps.id

        WHERE
            LOWER(ps.name) = 'paid'
            AND YEAR(p.paid_at) = YEAR(CURDATE())

        GROUP BY MONTH(p.paid_at)
    ";

        $result = mysqli_query($this->connection, $sql);

        $data = array_fill(0, 12, 0);

        while ($row = mysqli_fetch_assoc($result)) {
            $data[(int)$row["month"] - 1] = (float)$row["revenue"];
        }

        return [
            "labels" => [
                "Jan",
                "Feb",
                "Mar",
                "Apr",
                "May",
                "Jun",
                "Jul",
                "Aug",
                "Sep",
                "Oct",
                "Nov",
                "Dec"
            ],
            "data" => $data
        ];
    }

    public function countRooms(): int
    {
        $sql = "
            SELECT COUNT(*) AS total
            FROM rooms
        ";

        $result = mysqli_query($this->connection, $sql);

        return (int) mysqli_fetch_assoc($result)["total"];
    }

    public function countAvailableRooms(): int
    {
        $sql = "
            SELECT COUNT(*) AS total
            FROM rooms r
            INNER JOIN room_statuses rs
                ON r.status_id = rs.id
            WHERE LOWER(rs.name) = 'available'
        ";

        $result = mysqli_query($this->connection, $sql);

        return (int) mysqli_fetch_assoc($result)["total"];
    }

    public function countOccupiedRooms(): int
    {
        $sql = "
            SELECT COUNT(DISTINCT r.room_id) AS total
            FROM stays s
            INNER JOIN reservations r
                ON s.reservation_id = r.id
            WHERE s.checked_out_at IS NULL
        ";

        $result = mysqli_query($this->connection, $sql);

        return (int) mysqli_fetch_assoc($result)["total"];
    }

    public function countMaintenanceRooms(): int
    {
        $sql = "
            SELECT COUNT(*) AS total
            FROM rooms r
            INNER JOIN room_statuses rs
                ON r.status_id = rs.id
            WHERE LOWER(rs.name) = 'maintenance'
        ";

        $result = mysqli_query($this->connection, $sql);

        return (int) mysqli_fetch_assoc($result)["total"];
    }

    public function countTodayReservations(): int
    {
        $sql = "
            SELECT COUNT(*) AS total
            FROM reservations
            WHERE DATE(created_at) = CURDATE()
        ";

        $result = mysqli_query($this->connection, $sql);

        return (int) mysqli_fetch_assoc($result)["total"];
    }

    public function countExpectedCheckIns(): int
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

        $result = mysqli_query($this->connection, $sql);

        return (int) mysqli_fetch_assoc($result)["total"];
    }

    public function countExpectedCheckOuts(): int
    {
        $sql = "
            SELECT COUNT(*) AS total
            FROM stays s
            INNER JOIN reservations r
                ON s.reservation_id = r.id
            WHERE
                r.check_out = CURDATE()
                AND s.checked_out_at IS NULL
        ";

        $result = mysqli_query($this->connection, $sql);

        return (int) mysqli_fetch_assoc($result)["total"];
    }

    public function getMonthlyRevenue(): float
    {
        $sql = "
            SELECT
                COALESCE(SUM(p.amount), 0) AS total
            FROM payments p
            INNER JOIN payment_statuses ps
                ON p.status_id = ps.id
            WHERE
                LOWER(ps.name) = 'paid'
                AND YEAR(p.paid_at) = YEAR(CURDATE())
                AND MONTH(p.paid_at) = MONTH(CURDATE())
        ";

        $result = mysqli_query($this->connection, $sql);

        return (float) mysqli_fetch_assoc($result)["total"];
    }
}
