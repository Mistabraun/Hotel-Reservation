<?php

require_once __DIR__ . "/../../app/helper/Response.php";
require_once __DIR__ . "/../../app/middleware/Authmidlleware.php";
require_once __DIR__ . "/../../app/services/CustomerService.php";

AuthMiddleware::admin();
AuthMiddleware::method("POST");

$id = (int)($_POST["id"] ?? 0);

$customerService = new CustomerService();

$response = $customerService->update(
    $id,
    $_POST
);

Response::json($response);
