<?php

require_once __DIR__ . "/../../app/helper/Response.php";
require_once __DIR__ . "/../../app/middleware/Authmidlleware.php";
require_once __DIR__ . "/../../app/services/ReservationService.php";

AuthMiddleware::user();
AuthMiddleware::method("POST");

$reservationService = new ReservationService();
$response = $reservationService->create($_POST);

Response::json($response);
