<?php

require_once __DIR__ . "/../../config/Database.php";
require_once __DIR__ . "/../../app/helper/QueryOptions.php";

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
        string $bedType
    ): int|false {
        $sql = "
        INSERT INTO rooms (
            room_name,
            room_type_id,
            status_id,
            room_number,
            bed_type
        )
        VALUES (?, ?, ?, ?, ?)
    ";

        $statement = mysqli_prepare($this->connection, $sql);

        mysqli_stmt_bind_param(
            $statement,
            "siiis",
            $roomName,
            $roomTypeId,
            $roomNumber,
            $statusId,
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
        string $bedType
    ): bool {
        $sql = "
        UPDATE rooms
        SET
            room_number = ?,
            room_name = ?,
            room_type_id = ?,
            status_id = ?,
            bed_type = ?
        WHERE id = ?
    ";

        $statement = mysqli_prepare($this->connection, $sql);

        mysqli_stmt_bind_param(
            $statement,
            "isiidi",
            $roomNumber,
            $roomName,
            $roomTypeId,
            $statusId,
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
            r.id,
            r.room_name,
            r.room_number,
            r.size,
            r.bed_type,

            rt.id AS room_type_id,
            rt.name AS room_type,
            rt.description,
            rt.price_per_night,
            rt.capacity,

            rs.id AS status_id,
            rs.name AS status

        FROM rooms r

        INNER JOIN room_types rt
            ON r.room_type_id = rt.id

        INNER JOIN room_statuses rs
            ON r.status_id = rs.id

        WHERE r.id = ?
    ";

        $statement = mysqli_prepare($this->connection, $sql);
        mysqli_stmt_bind_param($statement, "i", $id);
        mysqli_stmt_execute($statement);

        $result = mysqli_stmt_get_result($statement);

        $room = mysqli_fetch_assoc($result);

        if (!$room) {
            return null;
        }

        $sql = "
        SELECT
            a.id,
            a.name

        FROM room_type_amenities rta

        INNER JOIN amenities a
            ON rta.amenity_id = a.id

        WHERE rta.room_type_id = ?

        ORDER BY a.name
    ";

        $statement = mysqli_prepare($this->connection, $sql);
        mysqli_stmt_bind_param(
            $statement,
            "i",
            $room["room_type_id"]
        );

        mysqli_stmt_execute($statement);

        $result = mysqli_stmt_get_result($statement);

        $room["amenities"] = mysqli_fetch_all(
            $result,
            MYSQLI_ASSOC
        );

        return $room;
    }

    public function count(
        QueryOptions $options
    ): int {


        $search = trim($options->search);
        $roomSearch = preg_replace('/^room\s*/i', '', $search);

        $sql = "
        SELECT COUNT(*) total

        FROM rooms r

        INNER JOIN room_types rt
            ON rt.id = r.room_type_id

        INNER JOIN room_statuses rs
            ON rs.id = r.status_id

        WHERE 1 = 1
    ";

        $types = "";
        $params = [];

        if ($options->filter !== "all") {

            $sql .= "
            AND LOWER(rs.name) = ?
        ";

            $types .= "s";
            $params[] = $options->filter;
        }

        if ($search !== "") {

            $sql .= "
        AND (
            r.room_name LIKE ?
            OR CAST(r.room_number AS CHAR) LIKE ?
            OR rt.name LIKE ?
        )
    ";

            $keyword = "%{$search}%";
            $roomKeyword = "%{$roomSearch}%";

            $types .= "sss";

            $params[] = $keyword;       // room name
            $params[] = $roomKeyword;   // room number
            $params[] = $keyword;       // room type
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

        return (int)mysqli_fetch_assoc(
            $result
        )["total"];
    }

    public function getAll(QueryOptions $options): array
    {
        $sql = "
        SELECT
            r.id,
            r.room_name,
            r.room_number,
            r.size,
            r.bed_type,

            rt.id AS room_type_id,
            rt.name AS room_type,
            rt.description,
            rt.price_per_night,
            rt.capacity,

            rs.id AS status_id,
            rs.name AS status

        FROM rooms r

        INNER JOIN room_types rt
            ON r.room_type_id = rt.id

        INNER JOIN room_statuses rs
            ON r.status_id = rs.id

        WHERE 1 = 1
    ";

        $types = "";
        $params = [];

        if ($options->filter !== "all") {

            $sql .= "
            AND LOWER(rs.name) = ?
        ";

            $types .= "s";
            $params[] = strtolower($options->filter);
        }

        if ($options->search !== "") {

            $search = trim($options->search);

            // Allow searching "Room 101"
            $roomSearch = preg_replace(
                '/^room\s*/i',
                '',
                $search
            );

            $keyword = "%{$search}%";
            $roomKeyword = "%{$roomSearch}%";

            $sql .= "
            AND (
                r.room_name LIKE ?
                OR CAST(r.room_number AS CHAR) LIKE ?
                OR rt.name LIKE ?
            )
        ";

            $types .= "sss";

            $params[] = $keyword;
            $params[] = $roomKeyword;
            $params[] = $keyword;
        }

        $sql .= "
        ORDER BY r.room_number ASC
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
