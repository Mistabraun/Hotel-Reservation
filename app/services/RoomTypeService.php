<?php

require_once __DIR__ . "/BaseService.php";

require_once __DIR__ . "/../models/RoomType.php";
require_once __DIR__ . "/../models/Amenity.php";
require_once __DIR__ . "/../models/RoomTypeAmenity.php";

class RoomTypeService extends BaseService
{
    private RoomType $roomType;
    private RTA $roomTypeAmenity;
    private Amenity $amenity;
    private mysqli $connection;

    public function __construct()
    {
        $this->roomType = new RoomType();
        $this->roomTypeAmenity = new RTA();
        $this->amenity = new Amenity();

        $this->connection = Database::connect();
    }

    public function create(array $data): array
    {
        $name = trim($data["name"] ?? "");
        $description = trim($data["description"] ?? "");
        $price = (float)($data["price"] ?? 0);
        $capacity = (int)($data["capacity"] ?? 0);
        $amenities = $data["amenities"] ?? [];

        if ($name === "") {
            return $this->error("Room type name is required.");
        }

        if ($description === "") {
            return $this->error("Description is required.");
        }

        if ($price <= 0) {
            return $this->error("Price must be greater than zero.");
        }

        if ($capacity <= 0) {
            return $this->error("Capacity must be at least 1.");
        }

        if ($this->roomType->existsByName($name)) {
            return $this->error("Room type already exists.");
        }

        mysqli_begin_transaction($this->connection);

        try {

            $roomTypeId = $this->roomType->create(
                $name,
                $description,
                $price,
                $capacity
            );

            if (!$roomTypeId) {
                throw new Exception("Unable to create room type.");
            }

            $this->saveAmenities($roomTypeId, $amenities);

            mysqli_commit($this->connection);

            return $this->success(
                "Room type created successfully.",
                [
                    "id" => $roomTypeId
                ]
            );
        } catch (Exception $e) {

            mysqli_rollback($this->connection);

            return $this->error($e->getMessage());
        }
    }

    public function update(array $data): array
    {
        $id = (int)($data["id"] ?? 0);

        $name = trim($data["name"] ?? "");
        $description = trim($data["description"] ?? "");
        $price = (float)($data["price"] ?? 0);
        $capacity = (int)($data["capacity"] ?? 0);
        $amenities = $data["amenities"] ?? [];

        if ($id <= 0) {
            return $this->error("Invalid room type.");
        }

        if ($name === "") {
            return $this->error("Room type name is required.");
        }

        if ($description === "") {
            return $this->error("Description is required.");
        }

        if ($price <= 0) {
            return $this->error("Price must be greater than zero.");
        }

        if ($capacity <= 0) {
            return $this->error("Capacity must be at least 1.");
        }

        if ($this->roomType->existsByName($name, $id)) {
            return $this->error("Room type already exists.");
        }

        mysqli_begin_transaction($this->connection);

        try {

            if (
                !$this->roomType->update(
                    $id,
                    $name,
                    $description,
                    $price,
                    $capacity
                )
            ) {
                throw new Exception("Unable to update room type.");
            }

            $this->saveAmenities($id, $amenities);

            mysqli_commit($this->connection);

            return $this->success(
                "Room type updated successfully."
            );
        } catch (Exception $e) {

            mysqli_rollback($this->connection);

            return $this->error($e->getMessage());
        }
    }

    public function delete(int $id): array
    {
        mysqli_begin_transaction($this->connection);

        try {

            if (
                !$this->roomTypeAmenity->deleteByRoomTypeId($id)
            ) {
                throw new Exception("Unable to delete amenities.");
            }

            if (
                !$this->roomType->delete($id)
            ) {
                throw new Exception("Unable to delete room type.");
            }

            mysqli_commit($this->connection);

            return $this->success(
                "Room type deleted successfully."
            );
        } catch (Exception $e) {

            mysqli_rollback($this->connection);

            return $this->error($e->getMessage());
        }
    }

    public function getAll(): array
    {
        $roomTypes = $this->roomType->getAll();

        foreach ($roomTypes as &$roomType) {

            $roomType["amenities"] =
                $this->roomTypeAmenity->getByRoomTypeId(
                    $roomType["id"]
                );
        }

        return $this->success(
            "Room types retrieved successfully.",
            $roomTypes
        );
    }

    
    public function getAmenities(int $roomTypeId): array
    {
        $amenities = $this->roomTypeAmenity
            ->getByRoomTypeId($roomTypeId);

        return $this->success(
            "Amenities retrieved successfully.",
            $amenities
        );
    }

    public function getById(int $id): array
    {
        $roomType = $this->roomType->findById($id);

        if (!$roomType) {
            return $this->error("Room type not found.");
        }

        $roomType["amenities"] =
            $this->roomTypeAmenity->getByRoomTypeId($id);

        return $this->success(
            "Room type retrieved successfully.",
            $roomType
        );
    }

    private function saveAmenities(
        int $roomTypeId,
        array $amenityIds
    ): void {

        foreach ($amenityIds as $amenityId) {

            if (
                !$this->amenity->findById((int)$amenityId)
            ) {
                throw new Exception(
                    "Amenity '{$amenityId}' does not exist."
                );
            }
        }

        if (
            !$this->roomTypeAmenity->replace(
                $roomTypeId,
                $amenityIds
            )
        ) {
            throw new Exception(
                "Unable to save room type amenities."
            );
        }
    }
}
