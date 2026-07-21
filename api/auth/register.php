<?php

include_once __DIR__ . "/../../app/services/AuthService.php";
include_once __DIR__ . "/../../app/helper/Response.php";
include_once __DIR__ . "/../../app/middleware/Authmidlleware.php";

AuthMiddleware::guest();
AuthMiddleware::method("POST");

$customerService = new CustomerService();

$response = $customerService->register($_POST);

Response::json($response);
