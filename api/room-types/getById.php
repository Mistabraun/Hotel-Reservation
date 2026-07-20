<?php

require_once __DIR__ . "/../../app/helper/Response.php";
require_once __DIR__ . "/../../app/middleware/Authmidlleware.php";
require_once __DIR__ . "/../../app/services/RoomTypeService.php";

AuthMiddleware::admin();
AuthMiddleware::method("GET");

$id = (int)($_GET["id"] ?? 0);

if ($id <= 0) {
    Response::error("Invalid room type.", 400);
}

$service = new RoomTypeService();

$result = $service->getById($id);

if (!$result["success"]) {
    Response::error($result["message"], 404);
}

Response::json($result);
