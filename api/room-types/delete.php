<?php

require_once __DIR__ . "/../../app/helper/Response.php";
require_once __DIR__ . "/../../app/middleware/Authmidlleware.php";
require_once __DIR__ . "/../../app/services/RoomTypeService.php";

AuthMiddleware::admin();
AuthMiddleware::method("POST");

$id = (int)($_POST["id"] ?? 0);

if ($id <= 0) {
    Response::error("Invalid room type.", 400);
}

$service = new RoomTypeService();

$result = $service->delete($id);

if (!$result["success"]) {
    Response::error($result["message"], 400);
}

Response::json($result);
