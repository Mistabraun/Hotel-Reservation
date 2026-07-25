<?php

require_once __DIR__ . "/../../../app/helper/Response.php";
require_once __DIR__ . "/../../../app/middleware/Authmidlleware.php";
require_once __DIR__ . "/../../../app/services/BookingService.php";

AuthMiddleware::method("POST");

$service = new BookingService();

Response::json(
    $service->book($_POST)
);
