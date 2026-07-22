<?php

require_once __DIR__ . "/../../config/Database.php";

class Room
{
    private mysqli $connection;

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
        string $bedType
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
            bed_type
        )
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    ";

        $statement = mysqli_prepare($this->connection, $sql);

        mysqli_stmt_bind_param(
            $statement,
            "siiidiss",
            $roomName,
            $roomTypeId,
            $roomNumber,
            $statusId,
            $pricePerNight,
            $capacity,
            $size,
            $bedType
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
        string $bedType
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
            bed_type = ?
        WHERE id = ?
    ";

        $statement = mysqli_prepare($this->connection, $sql);

        mysqli_stmt_bind_param(
            $statement,
            "isiididsi",
            $roomNumber,
            $roomName,
            $roomTypeId,
            $statusId,
            $price,
            $capacity,
            $size,
            $bedType,
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
}
