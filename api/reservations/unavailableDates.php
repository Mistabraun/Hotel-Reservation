<?php

require_once __DIR__ . "/../../app/helper/Response.php";
require_once __DIR__ . "/../../app/middleware/Authmidlleware.php";
require_once __DIR__ . "/../../app/services/ReservationService.php";

AuthMiddleware::user();
AuthMiddleware::method("GET");

$reservationService = new ReservationService();

$id = (int)($_GET["id"] ?? 0);
$reservationId = (int)($_GET["reservation"] ?? 0);


$response = $reservationService->getUnavailableDates($id, $reservationId);

Response::json($response);
