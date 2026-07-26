<?php

require_once __DIR__ . "/../../app/helper/Response.php";
require_once __DIR__ . "/../../app/middleware/Authmidlleware.php";
require_once __DIR__ . "/../../app/services/GuestService.php";

AuthMiddleware::admin();
AuthMiddleware::method("GET");

$service = new GuestService();

Response::json(
    $service->getGuests($_GET)
);
