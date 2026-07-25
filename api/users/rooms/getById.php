<?php

require_once __DIR__ . "/../../../app/helper/Response.php";
require_once __DIR__ . "/../../../app/services/RoomService.php";

$service = new RoomService();

Response::json(
    $service->getClientRoomById($_GET)
);
