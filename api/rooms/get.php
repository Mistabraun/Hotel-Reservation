<?php

require_once __DIR__ . "/../../app/middleware/Authmidlleware.php";
require_once __DIR__ . "/../../app/services/RoomService.php";
require_once __DIR__ . "/../../app/helper/Response.php";

AuthMiddleware::admin();
AuthMiddleware::method("GET");

$roomService = new RoomService();


$result = $roomService->getRooms($_GET);

if (!$result["success"]) {
    Response::error($result["message"]);
}

Response::json($result);
