<?php

require_once __DIR__ . "/../../app/middleware/Authmidlleware.php";
require_once __DIR__ . "/../../app/services/RoomService.php";
require_once __DIR__ . "/../../app/helper/Response.php";


AuthMiddleware::admin();
AuthMiddleware::method("POST");

$id = (int)($_POST["id"] ?? 0);

$roomService = new RoomService();

$result = $roomService->delete($id);

if (!$result["success"]) {
    Response::error($result["message"]);
}

Response::json($result);
