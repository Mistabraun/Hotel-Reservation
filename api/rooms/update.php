<?php

require_once __DIR__ . "/../../app/middleware/Authmidlleware.php";
require_once __DIR__ . "/../../app/services/RoomService.php";
require_once __DIR__ . "/../../app/helper/Response.php";

AuthMiddleware::admin();
AuthMiddleware::method("POST");

$roomService = new RoomService();

$result = $roomService->update($_POST, $_FILES);

if (!$result["success"]) {
    Response::error($result["message"]);
}

Response::json($result);
