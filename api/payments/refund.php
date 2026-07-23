<?php

require_once __DIR__ . "/../../app/helper/Response.php";
require_once __DIR__ . "/../../app/middleware/AuthMiddleware.php";
require_once __DIR__ . "/../../app/services/PaymentService.php";

AuthMiddleware::admin();
AuthMiddleware::method("POST");

$id = (int)($_POST["id"] ?? 0);

$service = new PaymentService();

Response::json(
    $service->refund($id)
);
