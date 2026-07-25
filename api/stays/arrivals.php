<?php

require_once __DIR__ . "/../../app/helper/Response.php";
require_once __DIR__ . "/../../app/middleware/Authmidlleware.php";
require_once __DIR__ . "/../../app/services/StayService.php";

AuthMiddleware::method("GET");

$stayService = new StayService();

Response::json(
    $stayService->getTodayArrivals($_GET)
);
