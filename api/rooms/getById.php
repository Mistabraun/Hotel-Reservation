<?php

require_once __DIR__ . "/../../app/middleware/Authmidlleware.php";
require_once __DIR__ . "/../../app/services/RoomService.php";
require_once __DIR__ . "/../../app/helper/Response.php";

AuthMiddleware::admin();
AuthMiddleware::method("GET");

$id = (int)($_GET["id"] ?? 0);

if ($id <= 0) {
    Response::error("Invalid room ID.", 400);
}

$roomService = new RoomService();

$result = $roomService->getById($id);

if (!$result["success"]) {
    Response::error($result["message"], 404);
}

Response::json($result);
