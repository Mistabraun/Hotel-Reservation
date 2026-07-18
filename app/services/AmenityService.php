<?php

include_once __DIR__ . "/../models/Amenity.php";
include_once __DIR__ . "/BaseService.php";

class AmenityService extends BaseService
{
    private Amenity $amenity;

    public function __construct()
    {
        $this->amenity = new Amenity();
    }

    public function getAll(): array
    {
        $amenities = $this->amenity->getAll();

        return $this->success($amenities);
    }
}
