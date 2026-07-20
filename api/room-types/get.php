<?php

require_once __DIR__ . "/../../app/helper/Response.php";
require_once __DIR__ . "/../../app/middleware/Authmidlleware.php";
require_once __DIR__ . "/../../app/services/RoomTypeService.php";

AuthMiddleware::admin();
AuthMiddleware::method("GET");

$service = new RoomTypeService();

$result = $service->getAll();

Response::json($result);
