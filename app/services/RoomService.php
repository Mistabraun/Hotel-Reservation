<?php

require_once __DIR__ . "/../models/Room.php";
include_once __DIR__ . "/BaseService.php";

class RoomService extends BaseService
{
    private Room $room;
    private mysqli $connection;

    public function __construct()
    {
        $this->room = new Room();
    }


    public function create(array $data): array
    {
        $roomName = trim($data["room_name"] ?? "");
        $amenities = $data["amenities"] ?? [];

        if (empty($roomName)) {
            return $this->error("Room name is required.");
        }

        mysqli_begin_transaction($this->connection);

        try {

            $roomId = $this->room->create($roomName);

            if (!$roomId) {
                return $this->error("Unable to create room.");
            }

            foreach ($amenities as $amenityId) {

                if (!$this->room->addAmenity(
                    $roomId,
                    (int)$amenityId
                )) {
                    return $this->error("Unable to save amenities.");
                }
            }

            mysqli_commit($this->connection);

            return $this->success($roomId);
        } catch (Exception $e) {

            mysqli_rollback($this->connection);

            return $this->error("Internal Server Error.");
        }
    }
}
