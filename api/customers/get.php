<?php

require_once __DIR__ . "/../../app/helper/Response.php";
require_once __DIR__ . "/../../app/middleware/Authmidlleware.php";
require_once __DIR__ . "/../../app/services/CustomerService.php";

AuthMiddleware::admin();

AuthMiddleware::method("GET");

$customerService = new CustomerService();

$response = $customerService->getAll();

Response::json($response);
