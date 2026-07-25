<?php

require_once __DIR__ . "/../../config/Database.php";

class Report
{
    private mysqli $connection;

    public function __construct()
    {
        $this->connection = Database::connect();
    }

    public function getPerformanceOverview(): array
    {
        $currentYear = date("Y");
        $lastYear = $currentYear - 1;

        return [
            "overview" => [
                "revenue" => [
                    "this_year" => $this->getRevenue($currentYear),
                    "last_year" => $this->getRevenue($lastYear)
                ],
                "occupancy" => [
                    "this_year" => $this->getOccupancyRate($currentYear),
                    "last_year" => $this->getOccupancyRate($lastYear)
                ],
                "adr" => [
                    "this_year" => $this->getADR($currentYear),
                    "last_year" => $this->getADR($lastYear)
                ],
                "revpar" => [
                    "this_year" => $this->getRevPAR($currentYear),
                    "last_year" => $this->getRevPAR($lastYear)
                ]
            ],

            "charts" => [

                "monthly_revenue" =>
                $this->getMonthlyRevenueTrend(),

                "weekly_occupancy" =>
                $this->getWeeklyOccupancyTrend(),

                "room_type_revenue" =>
                $this->getRevenueByRoomType()

            ],
            "tables" => [

                "room_type_performance" =>
                $this->getRoomTypePerformance(),

                "top_guests" =>
                $this->getTopGuests()

            ]
        ];
    }

    public function getRoomTypePerformance(): array
    {
        $sql = "
        SELECT

            rt.id,

            rt.name AS room_type,

            COUNT(DISTINCT rm.id) AS total_rooms,

            COUNT(DISTINCT CASE

                WHEN CURDATE() >= r.check_in
                AND CURDATE() < r.check_out
                THEN rm.id

            END) AS occupied_rooms,

            COALESCE(AVG(rm.price_per_night),0) AS average_price,

            COALESCE(
                SUM(
                    CASE
                        WHEN LOWER(ps.name)='paid'
                        THEN p.amount
                        ELSE 0
                    END
                ),
            0) AS revenue

        FROM room_types rt

        LEFT JOIN rooms rm
            ON rm.room_type_id = rt.id

        LEFT JOIN reservations r
            ON r.room_id = rm.id

        LEFT JOIN payments p
            ON p.reservation_id = r.id

        LEFT JOIN payment_statuses ps
            ON ps.id = p.status_id

        GROUP BY
            rt.id,
            rt.name

        ORDER BY
            revenue DESC,
            rt.name ASC
    ";

        $result = mysqli_query(
            $this->connection,
            $sql
        );

        $rows = [];

        while ($row = mysqli_fetch_assoc($result)) {

            $totalRooms =
                (int)$row["total_rooms"];

            $occupied =
                (int)$row["occupied_rooms"];

            $rows[] = [

                "room_type" =>
                $row["room_type"],

                "total_rooms" =>
                $totalRooms,

                "occupied_rooms" =>
                $occupied,

                "occupancy_rate" =>
                $totalRooms > 0
                    ? round(
                        ($occupied / $totalRooms) * 100,
                        1
                    )
                    : 0,

                "average_price" =>
                round(
                    (float)$row["average_price"],
                    2
                ),

                "revenue" =>
                (float)$row["revenue"]

            ];
        }

        return $rows;
    }

    public function getRevenueByRoomType(): array
    {
        $sql = "
        SELECT
            rt.name AS room_type,

            COALESCE(
                SUM(
                    CASE
                        WHEN LOWER(ps.name) = 'paid'
                        AND YEAR(p.paid_at) = YEAR(CURDATE())
                        THEN p.amount
                        ELSE 0
                    END
                ),
                0
            ) AS revenue

        FROM room_types rt

        LEFT JOIN rooms rm
            ON rm.room_type_id = rt.id

        LEFT JOIN reservations r
            ON r.room_id = rm.id

        LEFT JOIN payments p
            ON p.reservation_id = r.id

        LEFT JOIN payment_statuses ps
            ON ps.id = p.status_id

        GROUP BY
            rt.id,
            rt.name

      ORDER BY
    revenue DESC,
    rt.name ASC
    ";

        $result = mysqli_query(
            $this->connection,
            $sql
        );

        $labels = [];
        $data = [];

        while ($row = mysqli_fetch_assoc($result)) {

            $labels[] = $row["room_type"];
            $data[] = (float)$row["revenue"];
        }

        return [
            "labels" => $labels,

            "datasets" => [[

                "label" => "Revenue",

                "data" => $data,

                "backgroundColor" => [
                    "#000000",
                    "#333333",
                    "#666666",
                    "#999999",
                    "#BBBBBB",
                    "#DDDDDD"
                ],

                "borderWidth" => 2,
                "borderColor" => "#ffffff"

            ]]
        ];
    }

    public function getTopGuests(int $limit = 10): array
    {
        $sql = "
        SELECT

            u.first_name,
            u.last_name,

            COUNT(DISTINCT r.id) AS total_stays,

            COALESCE(SUM(
                CASE
                    WHEN LOWER(ps.name) = 'paid'
                    THEN p.amount
                    ELSE 0
                END
            ),0) AS total_spent,

            MAX(r.check_out) AS last_stay

        FROM customers u

        INNER JOIN reservations r
            ON r.customer_id = u.id

        LEFT JOIN payments p
            ON p.reservation_id = r.id

        LEFT JOIN payment_statuses ps
            ON ps.id = p.status_id

        GROUP BY
            u.id

        ORDER BY
            total_spent DESC,
            total_stays DESC,
            last_stay DESC

        LIMIT ?
    ";

        $statement = mysqli_prepare(
            $this->connection,
            $sql
        );

        mysqli_stmt_bind_param(
            $statement,
            "i",
            $limit
        );

        mysqli_stmt_execute($statement);

        $result = mysqli_stmt_get_result($statement);

        $rows = [];

        while ($row = mysqli_fetch_assoc($result)) {

            $stays = (int)$row["total_stays"];
            $spent = (float)$row["total_spent"];

            if ($spent >= 15000 || $stays >= 5) {
                $status = "VIP";
            } else {
                $status = "Regular";
            }

            $rows[] = [

                "guest" =>
                trim(
                    $row["first_name"] .
                        " " .
                        $row["last_name"]
                ),

                "total_stays" =>
                $stays,

                "total_spent" =>
                $spent,

                "last_stay" =>
                $row["last_stay"],

                "status" =>
                $status

            ];
        }

        return $rows;
    }

    private function getRevenue(int $year): float
    {
        $sql = "
            SELECT
                COALESCE(SUM(p.amount),0) AS revenue
            FROM payments p

            INNER JOIN payment_statuses ps
                ON p.status_id = ps.id

            WHERE
                LOWER(ps.name)='paid'
                AND YEAR(p.paid_at)=?
        ";

        $statement = mysqli_prepare(
            $this->connection,
            $sql
        );

        mysqli_stmt_bind_param(
            $statement,
            "i",
            $year
        );

        mysqli_stmt_execute($statement);

        $result = mysqli_stmt_get_result($statement);

        return (float)mysqli_fetch_assoc($result)["revenue"];
    }

    private function getOccupiedRoomNights(int $year): int
    {
        $sql = "
            SELECT
                COALESCE(
                    SUM(
                        DATEDIFF(check_out, check_in)
                    ),
                0) AS nights

            FROM reservations r

            INNER JOIN reservation_statuses rs
                ON r.status_id = rs.id

            WHERE
                LOWER(rs.name) <> 'cancelled'
                AND YEAR(check_in)=?
        ";

        $statement = mysqli_prepare(
            $this->connection,
            $sql
        );

        mysqli_stmt_bind_param(
            $statement,
            "i",
            $year
        );

        mysqli_stmt_execute($statement);

        $result = mysqli_stmt_get_result($statement);

        return (int)mysqli_fetch_assoc($result)["nights"];
    }

    private function getRoomCount(): int
    {
        $sql = "
            SELECT COUNT(*) total
            FROM rooms
        ";

        $result = mysqli_query(
            $this->connection,
            $sql
        );

        return (int)mysqli_fetch_assoc($result)["total"];
    }

    private function getOccupancyRate(int $year): float
    {
        $roomCount = $this->getRoomCount();

        $days =
            date("L", strtotime("$year-01-01"))
            ? 366
            : 365;

        $availableRoomNights =
            $roomCount * $days;

        if ($availableRoomNights == 0) {
            return 0;
        }

        $occupied =
            $this->getOccupiedRoomNights($year);

        return round(
            ($occupied / $availableRoomNights) * 100,
            2
        );
    }

    private function getADR(int $year): float
    {
        $occupied =
            $this->getOccupiedRoomNights($year);

        if ($occupied == 0) {
            return 0;
        }

        return round(
            $this->getRevenue($year) / $occupied,
            2
        );
    }

    private function getRevPAR(int $year): float
    {
        $roomCount =
            $this->getRoomCount();

        $days =
            date("L", strtotime("$year-01-01"))
            ? 366
            : 365;

        $availableRoomNights =
            $roomCount * $days;

        if ($availableRoomNights == 0) {
            return 0;
        }

        return round(
            $this->getRevenue($year)
                / $availableRoomNights,
            2
        );
    }
    public function getMonthlyRevenueTrend(): array
    {
        $sql = "
        SELECT
            MONTH(p.paid_at) AS month,
            COALESCE(SUM(p.amount), 0) AS revenue,
            COALESCE(
                SUM(p.amount) /
                NULLIF(SUM(DATEDIFF(r.check_out, r.check_in)), 0),
                0
            ) AS adr

        FROM payments p

        INNER JOIN payment_statuses ps
            ON p.status_id = ps.id

        INNER JOIN reservations r
            ON p.reservation_id = r.id

        WHERE
            LOWER(ps.name) = 'paid'
            AND YEAR(p.paid_at) = YEAR(CURDATE())

        GROUP BY MONTH(p.paid_at)
        ORDER BY MONTH(p.paid_at)
    ";

        $result = mysqli_query(
            $this->connection,
            $sql
        );

        $revenue = array_fill(0, 12, 0);
        $adr = array_fill(0, 12, 0);

        while ($row = mysqli_fetch_assoc($result)) {

            $index = (int)$row["month"] - 1;

            $revenue[$index] = (float)$row["revenue"];
            $adr[$index] = round(
                (float)$row["adr"],
                2
            );
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
            "datasets" => [
                [
                    "type" => "scatter",
                    "label" => "ADR",
                    "data" => $adr
                ],
                [
                    "type" => "bar",
                    "label" => "Revenue",
                    "data" => $revenue
                ]
            ]
        ];
    }

    public function getWeeklyOccupancyTrend(): array
    {
        $roomCount = $this->getRoomCount();

        $sql = "
        SELECT
            d.day,
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

        $result = mysqli_query(
            $this->connection,
            $sql
        );

        $occupiedRooms = array_fill(0, 7, 0);
        $occupancyRate = array_fill(0, 7, 0);

        $index = 0;

        while ($row = mysqli_fetch_assoc($result)) {

            $occupied = (int)$row["occupied"];

            $occupiedRooms[$index] = $occupied;

            $occupancyRate[$index] = $roomCount > 0
                ? round(($occupied / $roomCount) * 100, 2)
                : 0;

            $index++;
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
            "datasets" => [
                [
                    "type" => "scatter",
                    "label" => "Occupied Rooms",
                    "data" => $occupiedRooms
                ],
                [
                    "type" => "line",
                    "label" => "Occupancy %",
                    "data" => $occupancyRate
                ]
            ]
        ];
    }
}
