<?php

require_once __DIR__ . "/../models/Room.php";
require_once __DIR__ . "/../models/Amenity.php";
require_once __DIR__ . "/../../config/Database.php";
require_once __DIR__ . "/BaseService.php";

class RoomService extends BaseService
{
    private Room $room;
    private Amenity $amenity;
    private mysqli $connection;

    public function __construct()
    {
        $this->connection = Database::connect();
        $this->amenity = new Amenity();
        $this->room = new Room();
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
                return $this->error("Unable to create room.");
            }

            foreach ($amenities as $amenityId) {

                $amenity = $this->amenity->findById($amenityId);

                if (!$amenity) {
                    return $this->error("Amenity '{$amenityId}' does not exist.");
                }

                if (!$this->room->addAmenity(
                    $roomId,
                    $amenity["id"]
                )) {
                    return $this->error("Unable to save amenities.");
                }
            }

            mysqli_commit($this->connection);

            return $this->success(
                [
                    "room_id" => $roomId
                ]
            );
        } catch (Exception $e) {

            mysqli_rollback($this->connection);

            return $this->error("Internal Server Error: " . $e);
        }
    }
}
