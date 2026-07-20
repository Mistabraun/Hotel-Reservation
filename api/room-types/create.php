<?php

require_once __DIR__ . "/../../app/helper/Response.php";
require_once __DIR__ . "/../../app/middleware/Authmidlleware.php";
require_once __DIR__ . "/../../app/services/RoomTypeService.php";

AuthMiddleware::admin();
AuthMiddleware::method("POST");

$service = new RoomTypeService();

$result = $service->create($_POST);

if (!$result["success"]) {
    Response::error($result["message"], 400);
}

Response::json($result);
