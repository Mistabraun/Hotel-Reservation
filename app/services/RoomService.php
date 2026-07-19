<?php

require_once __DIR__ . "/../models/Room.php";
require_once __DIR__ . "/../models/Amenity.php";
require_once __DIR__ . "/../models/RoomAmenity.php";
require_once __DIR__ . "/../../config/Database.php";
require_once __DIR__ . "/../helper/Pagination.php";
require_once __DIR__ . "/BaseService.php";

class RoomService extends BaseService
{
    private Room $room;
    private Amenity $amenity;
    private RoomAmenity $roomAmenity;
    private mysqli $connection;

    public function __construct()
    {
        $this->connection = Database::connect();
        $this->amenity = new Amenity();
        $this->room = new Room();
        $this->roomAmenity = new RoomAmenity();
    }

    private function saveAmenities(int $roomId, array $amenities): void
    {
        foreach ($amenities as $amenityId) {

            if (!$this->amenity->findById((int) $amenityId)) {
                throw new Exception("Invalid amenity selected.");
            }

            if (!$this->roomAmenity->add($roomId, (int) $amenityId)) {
                throw new Exception("Unable to save amenities.");
            }
        }
    }

    public function create(array $data): array
    {
        $roomName = trim($data["name"] ?? "");
        $roomType = trim($data["type"] ?? "");
        $roomNumber = (int)($data["room_number"] ?? 0);
        $status = trim($data["status"] ?? "");
        $price = (float)($data["price"] ?? 0);
        $capacity = (int)($data["capacity"] ?? 0);
        $size = trim($data["size"] ?? "");
        $bedType = trim($data["bed_type"] ?? "");
        $amenities = $data["amenities"] ?? [];

        if (empty($roomName)) {
            return $this->error("Room name is required.");
        }

        if (empty($roomType)) {
            return $this->error("Room type is required.");
        }
        if ($roomNumber <= 0) {
            return $this->error("Room number is required.");
        }

        if (empty($status)) {
            return $this->error("Room status is required.");
        }

        if ($price <= 0) {
            return $this->error("Price must be greater than zero.");
        }

        if ($capacity <= 0) {
            return $this->error("Capacity must be at least 1.");
        }

        if (empty($size)) {
            return $this->error("Room size is required.");
        }

        if (empty($bedType)) {
            return $this->error("Bed type is required.");
        }

        if ($this->room->findByRoomNumber($roomNumber)) {
            return $this->error("Room number already exists.");
        }

        mysqli_begin_transaction($this->connection);

        try {

            $roomId = $this->room->create(
                $roomName,
                $roomType,
                $roomNumber,
                $status,
                $price,
                $capacity,
                $size,
                $bedType
            );

            if (!$roomId) {
                throw new Exception("Unable to create room.");
            }

            $this->saveAmenities($roomId, $amenities);

            mysqli_commit($this->connection);

            return $this->success("Room added successfully.", [
                "room_id" => $roomId
            ]);
        } catch (Exception $e) {

            mysqli_rollback($this->connection);

            return $this->error("Internal Server Error: " . $e);
        }
    }

    public function update(array $data): array
    {
        $id = (int)($data["id"] ?? 0);

        $roomNumber = (int)($data["room_number"] ?? 0);
        $roomName = trim($data["name"] ?? "");
        $roomType = (int)($data["type"] ?? 0);
        $status = (int)($data["status"] ?? 0);
        $price = (float)($data["price"] ?? 0);
        $capacity = (int)($data["capacity"] ?? 0);
        $size = (float)($data["size"] ?? 0);
        $bedType = trim($data["bed_type"] ?? "");
        $amenities = $data["amenities"] ?? [];


        if (empty($roomName)) {
            return $this->error("Room name is required.");
        }

        if (empty($roomType)) {
            return $this->error("Room type is required.");
        }
        if ($roomNumber <= 0) {
            return $this->error("Room number is required.");
        }

        if (empty($status)) {
            return $this->error("Room status is required.");
        }

        if ($price <= 0) {
            return $this->error("Price must be greater than zero.");
        }

        if ($capacity <= 0) {
            return $this->error("Capacity must be at least 1.");
        }

        if (empty($size)) {
            return $this->error("Room size is required.");
        }

        if (empty($bedType)) {
            return $this->error("Bed type is required.");
        }

        if (!$this->room->findById($id)) {
            return $this->error("Room not found.");
        }

        if ($this->room->findByRoomNumber($roomNumber)) {
            return $this->error("Room number already exists.");
        }

        $room = $this->room->findByRoomNumber($roomNumber);

        if ($room && $room["id"] != $id) {
            return $this->error("Room number already exists.");
        }

        mysqli_begin_transaction($this->connection);

        try {

            if (!$this->room->update(
                $id,
                $roomNumber,
                $roomName,
                $roomType,
                $status,
                $price,
                $capacity,
                $size,
                $bedType
            )) {
                throw new Exception("Unable to update room.");
            }

            if (!$this->roomAmenity->deleteAll($id)) {
                throw new Exception("Unable to update amenities.");
            }

            $this->saveAmenities($id, $amenities);

            mysqli_commit($this->connection);

            return $this->success(
                "Room updated successfully.",
                [
                    "room_id" => $id
                ]
            );
        } catch (Exception $e) {

            mysqli_rollback($this->connection);

            return $this->error($e->getMessage());
        }
    }

    public function delete(int $id): array
    {
        if ($id <= 0) {
            return $this->error("Invalid room.");
        }

        $room = $this->room->findById($id);

        if (!$room) {
            return $this->error("Room not found.");
        }

        mysqli_begin_transaction($this->connection);

        try {

            if (!$this->room->delete($id)) {
                throw new Exception("Unable to delete room.");
            }

            mysqli_commit($this->connection);

            return $this->success(
                "Room deleted successfully."
            );
        } catch (Exception $e) {

            mysqli_rollback($this->connection);

            return $this->error(
                "Internal Server Error."
            );
        }
    }

    public function getRooms(array $query): array
    {
        $page = max(1, (int)($query["page"] ?? 1));
        $limit = max(1, min((int)($query["limit"] ?? 10), 100));

        $filter = strtolower(trim($query["filter"] ?? "all"));
        $search = trim($query["search"] ?? "");

        $offset = ($page - 1) * $limit;

        $rooms = $this->room->getAll(
            $offset,
            $limit,
            $filter,
            $search
        );

        $total = $this->room->count(
            $filter,
            $search
        );

        return $this->success(
            "Rooms retrieved successfully.",
            Pagination::create(
                $rooms,
                $page,
                $limit,
                $total
            )
        );
    }

    public function getById(int $id): array
    {
        $room = $this->room->findById($id);

        if (!$room) {
            return $this->error("Room not found.");
        }

        $amenities = $this->roomAmenity->getByRoomId($id);

        $room["amenities"] = array_column($amenities, "id");

        return $this->success(
            "Room retrieved successfully.",
            $room
        );
    }
}
