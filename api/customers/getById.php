<?php

require_once __DIR__ . "/../../app/helper/Response.php";
require_once __DIR__ . "/../../app/middleware/Authmidlleware.php";
require_once __DIR__ . "/../../app/services/CustomerService.php";

AuthMiddleware::admin();

AuthMiddleware::method("GET");

$id = (int)($_GET["id"] ?? 0);

$customerService = new CustomerService();

$response = $customerService->getById($id);

Response::json($response);
