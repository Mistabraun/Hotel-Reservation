<?php

require_once __DIR__ . "/../../app/helper/Response.php";
require_once __DIR__ . "/../../app/middleware/Authmidlleware.php";
require_once __DIR__ . "/../../app/services/ReservationService.php";

AuthMiddleware::user();
AuthMiddleware::method("GET");

$reservationService = new ReservationService();
$response = $reservationService->getStatusCounts();

Response::json($response);
