<?php

require_once __DIR__ . "/../../../app/helper/Response.php";
require_once __DIR__ . "/../../../app/middleware/Authmidlleware.php";
require_once __DIR__ . "/../../../app/services/RoomService.php";


AuthMiddleware::method("GET");
$service = new RoomService();

Response::json($service->getClientRooms($_GET));
