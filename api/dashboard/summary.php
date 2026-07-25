<?php

require_once __DIR__ . "/../../app/helper/Response.php";
require_once __DIR__ . "/../../app/middleware/Authmidlleware.php";
require_once __DIR__ . "/../../app/services/DashboardService.php";

AuthMiddleware::admin();

AuthMiddleware::method("GET");

$service = new DashboardService();

$response = $service->getSummary();

Response::json($response);
