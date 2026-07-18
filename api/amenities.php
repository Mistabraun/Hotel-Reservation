<?php

require_once __DIR__ . "/../app/middleware/Authmidlleware.php";
include_once __DIR__ . "/../app/helper/Response.php";
require_once __DIR__ . "/../app/services/AmenityService.php";

AuthMiddleware::admin();

if ($_SERVER["REQUEST_METHOD"] !== "GET") {
    Response::error("Method not allowed.", 405);
}

$service = new AmenityService();

Response::json(
    $service->getAll()
);
