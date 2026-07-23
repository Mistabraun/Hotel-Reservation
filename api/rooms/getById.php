<?php
require_once __DIR__ . "/../../app/middleware/Authmidlleware.php";
require_once __DIR__ . "/../../app/services/RoomService.php";
require_once __DIR__ . "/../../app/helper/Response.php";

AuthMiddleware::method("GET");

$id = (int)($_GET["id"] ?? 0);

$service = new RoomService();

$result = $service->getById($id);

if (!$result["success"]) {
    Response::error($result["message"], 404);
}

Response::json($result);
