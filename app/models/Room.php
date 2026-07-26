<?php

require_once __DIR__ . "/../../config/Database.php";

class Room
{
    private mysqli $connection;
    private const EXTRA_GUEST_FEE = 250;

    public function __construct()
    {
        $this->connection = Database::connect();
    }

    public function create(
        string $roomName,
        int $roomTypeId,
        int $statusId,
        int $roomNumber,
        float $pricePerNight,
        int $capacity,
        string $size,
        string $bedType,
        string $description
    ): int|false {
        $sql = "
        INSERT INTO rooms (
            room_name,
            room_type_id,
            status_id,
            room_number,
            price_per_night,
            capacity,
            size,
            bed_type,
            description
        )
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
    ";

        $statement = mysqli_prepare($this->connection, $sql);

        mysqli_stmt_bind_param(
            $statement,
            "siiidisss",
            $roomName,
            $roomTypeId,
            $roomNumber,
            $statusId,
            $pricePerNight,
            $capacity,
            $size,
            $bedType,
            $description
        );

        if (!mysqli_stmt_execute($statement)) {
            return false;
        }

        return mysqli_insert_id($this->connection);
    }

    public function update(
        int $id,
        int $roomNumber,
        string $roomName,
        int $roomTypeId,
        int $statusId,
        float $price,
        int $capacity,
        float $size,
        string $bedType,
        string $description
    ): bool {
        $sql = "
        UPDATE rooms
        SET
            room_number = ?,
            room_name = ?,
            room_type_id = ?,
            status_id = ?,
            price_per_night = ?,
            capacity = ?,
            size = ?,
            bed_type = ?,
            description = ?
        WHERE id = ?
    ";

        $statement = mysqli_prepare($this->connection, $sql);

        mysqli_stmt_bind_param(
            $statement,
            "isiididssi",
            $roomNumber,
            $roomName,
            $roomTypeId,
            $statusId,
            $price,
            $capacity,
            $size,
            $bedType,
            $description,
            $id
        );

        return mysqli_stmt_execute($statement);
    }

    public function delete(int $id): bool
    {
        $sql = "DELETE FROM rooms WHERE id = ?";

        $statement = mysqli_prepare($this->connection, $sql);
        mysqli_stmt_bind_param($statement, "i", $id);

        return mysqli_stmt_execute($statement);
    }

    public function findByRoomNumber(int $roomNumber): ?array
    {
        $sql = "SELECT *
            FROM rooms
            WHERE room_number = ?
            LIMIT 1";

        $statement = mysqli_prepare($this->connection, $sql);
        mysqli_stmt_bind_param($statement, "i", $roomNumber);
        mysqli_stmt_execute($statement);

        $result = mysqli_stmt_get_result($statement);

        return mysqli_fetch_assoc($result) ?: null;
    }

    public function findById(int $id): ?array
    {
        $sql = "
            SELECT
            r.*,
            rt.name AS room_type,
            rs.name AS status,
            ri.thumbnail,
            ri.cover_image
        FROM rooms r
        INNER JOIN room_types rt
            ON r.room_type_id = rt.id
        INNER JOIN room_statuses rs
            ON r.status_id = rs.id
        LEFT JOIN room_images ri
            ON ri.room_id = r.id
        WHERE r.id = ?
    ";

        $statement = mysqli_prepare($this->connection, $sql);
        mysqli_stmt_bind_param($statement, "i", $id);
        mysqli_stmt_execute($statement);

        $result = mysqli_stmt_get_result($statement);

        return mysqli_fetch_assoc($result) ?: null;
    }

    public function countAvailable(): int
    {
        $sql = "
        SELECT COUNT(*) AS total
        FROM rooms
        WHERE status_id = 1
    ";

        $result = mysqli_query(
            $this->connection,
            $sql
        );

        return (int) mysqli_fetch_assoc($result)["total"];
    }

    public function count(QueryOptions $options): int
    {
        $sql = "
        SELECT COUNT(*) total
        FROM rooms r
        INNER JOIN room_types rt
            ON r.room_type_id = rt.id
        INNER JOIN room_statuses rs
            ON r.status_id = rs.id
        WHERE 1=1
    ";

        $types = "";
        $params = [];

        if ($options->filter !== "all") {
            $sql .= " AND LOWER(rs.name) = ?";
            $types .= "s";
            $params[] = strtolower($options->filter);
        }

        if ($options->search !== "") {

            $sql .= "
            AND (
                r.room_name LIKE ?
                OR r.room_number LIKE ?
                OR rt.name LIKE ?
            )
        ";

            $keyword = "%{$options->search}%";

            $types .= "sss";

            $params[] = $keyword;
            $params[] = $keyword;
            $params[] = $keyword;
        }

        $statement = mysqli_prepare($this->connection, $sql);

        if (!empty($params)) {
            mysqli_stmt_bind_param(
                $statement,
                $types,
                ...$params
            );
        }

        mysqli_stmt_execute($statement);

        $result = mysqli_stmt_get_result($statement);

        return (int)mysqli_fetch_assoc($result)["total"];
    }

    public function getAll(QueryOptions $options): array
    {
        $sql = "
            SELECT
                r.*,
                rt.name AS room_type,
                rs.name AS status,
                ri.thumbnail,
                ri.cover_image
            FROM rooms r
            INNER JOIN room_types rt
                ON r.room_type_id = rt.id
            INNER JOIN room_statuses rs
                ON r.status_id = rs.id
            LEFT JOIN room_images ri
                ON ri.room_id = r.id
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
                r.room_name LIKE ?
                OR CONCAT('Room ', r.room_number) LIKE ?
                OR r.room_number LIKE ?
                OR rt.name LIKE ?
            )
        ";

            $keyword = "%{$options->search}%";

            $types .= "ssss";

            $params[] = $keyword;
            $params[] = $keyword;
            $params[] = $keyword;
            $params[] = $keyword;
        }

        $sql .= "
        ORDER BY r.id ASC
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


    public function getClientRooms(
        ?string $roomType = null,
        ?int $capacity = null
    ): array {

        $sql = "
        SELECT
            r.id,
            r.room_name,
            r.room_type_id,
            r.price_per_night,
            r.capacity,
            r.size,
            r.bed_type,
            rt.name AS room_type,
            rs.name AS status,
            ri.thumbnail

        FROM rooms r

        INNER JOIN room_types rt
            ON r.room_type_id = rt.id

        INNER JOIN room_statuses rs
            ON r.status_id = rs.id

        LEFT JOIN room_images ri
            ON ri.room_id = r.id

        WHERE LOWER(rs.name) = 'available'
    ";

        $types = "";
        $params = [];

        if (!empty($roomType)) {

            $sql .= " AND LOWER(rt.name) = LOWER(?)";

            $types .= "s";
            $params[] = trim($roomType);
        }

        if (!empty($capacity)) {

            $sql .= " AND r.capacity >= ?";

            $types .= "i";
            $params[] = $capacity;
        }

        $sql .= "
        ORDER BY
            r.price_per_night ASC,
            r.room_name ASC
    ";

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

        $rooms = [];

        while ($row = mysqli_fetch_assoc($result)) {

            $amenitySql = "
        SELECT
            a.id,
            a.name
        FROM room_amenities ra

        INNER JOIN amenities a
            ON ra.amenity_id = a.id

        WHERE ra.room_id = ?

        ORDER BY a.name
    ";

            $amenityStatement = mysqli_prepare(
                $this->connection,
                $amenitySql
            );

            mysqli_stmt_bind_param(
                $amenityStatement,
                "i",
                $row["id"]
            );

            mysqli_stmt_execute($amenityStatement);

            $amenityResult = mysqli_stmt_get_result($amenityStatement);

            $row["amenities"] = [];

            while ($amenity = mysqli_fetch_assoc($amenityResult)) {
                $row["amenities"][] = $amenity;
            }

            $rooms[] = $row;
        }

        return $rooms;
    }


    public function getClientRoomById(int $id): ?array
    {
        $sql = "
        SELECT
            r.id,
            r.room_name,
            r.description,
            r.room_type_id,
            r.price_per_night,
            r.capacity,
            r.size,
            r.bed_type,
            rt.name AS room_type,
            rs.name AS status

        FROM rooms r

        INNER JOIN room_types rt
            ON r.room_type_id = rt.id

        INNER JOIN room_statuses rs
            ON r.status_id = rs.id

        WHERE
            r.id = ?

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

        $result = mysqli_stmt_get_result($statement);

        $room = mysqli_fetch_assoc($result);

        if (!$room) {
            return null;
        }

        // Images
        $sql = "
        SELECT
            thumbnail,
            cover_image
        FROM room_images
        WHERE room_id = ?
        ORDER BY thumbnail DESC, id ASC
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

        $result = mysqli_stmt_get_result($statement);

        $room["images"] = [];

        while ($image = mysqli_fetch_assoc($result)) {
            $room["images"][] = $image;
        }

        // Amenities
        $sql = "
        SELECT
            a.id,
            a.name

        FROM room_amenities ra

        INNER JOIN amenities a
            ON ra.amenity_id = a.id

        WHERE ra.room_id = ?

        ORDER BY a.name
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

        $result = mysqli_stmt_get_result($statement);

        $room["amenities"] = [];

        while ($amenity = mysqli_fetch_assoc($result)) {
            $room["amenities"][] = $amenity;
        }

        return $room;
    }

    private function getRoomPricing(int $roomId): ?array
    {
        $sql = "
        SELECT
            price_per_night,
            capacity
        FROM rooms
        WHERE id = ?
        LIMIT 1
    ";

        $statement = mysqli_prepare(
            $this->connection,
            $sql
        );

        mysqli_stmt_bind_param(
            $statement,
            "i",
            $roomId
        );

        mysqli_stmt_execute($statement);

        $result = mysqli_stmt_get_result($statement);

        return mysqli_fetch_assoc($result) ?: null;
    }

    public function calculate(
        int $roomId,
        string $checkIn,
        string $checkOut,
        int $guestCount
    ): array {

        $room = $this->getRoomPricing($roomId);

        if (!$room) {
            return [
                "success" => false,
                "message" => "Room not found."
            ];
        }

        $checkInDate = new DateTime($checkIn);
        $checkOutDate = new DateTime($checkOut);

        $nights = $checkInDate->diff($checkOutDate)->days;

        $includedGuests = (int)$room["capacity"];

        $extraGuests = max(
            0,
            $guestCount - $includedGuests
        );

        $extraGuestFeePerNight = $extraGuests * self::EXTRA_GUEST_FEE;

        $nightlyRate =
            (float)$room["price_per_night"] +
            $extraGuestFeePerNight;

        $totalAmount =
            $nightlyRate * $nights;

        return [
            "success" => true,
            "data" => [
                "nights" => $nights,
                "room_price" => (float)$room["price_per_night"],
                "included_guests" => $includedGuests,
                "guest_count" => $guestCount,
                "extra_guests" => $extraGuests,
                "extra_guest_fee_per_night" => $extraGuestFeePerNight,
                "nightly_rate" => $nightlyRate,
                "total_amount" => $totalAmount
            ]
        ];
    }
}
