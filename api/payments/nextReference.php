<?php

require_once __DIR__ . "/../../app/helper/Response.php";
require_once __DIR__ . "/../../app/middleware/AuthMiddleware.php";
require_once __DIR__ . "/../../app/services/PaymentService.php";

AuthMiddleware::admin();
AuthMiddleware::method("GET");

$service = new PaymentService();

Response::json(
    $service->getNextReference()
);
