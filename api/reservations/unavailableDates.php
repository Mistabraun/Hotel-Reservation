<?php

require_once __DIR__ . "/../../app/helper/Response.php";
require_once __DIR__ . "/../../app/middleware/Authmidlleware.php";
require_once __DIR__ . "/../../app/services/ReservationService.php";

AuthMiddleware::user();
AuthMiddleware::method("GET");

$reservationService = new ReservationService();

$id = (int)($_GET["id"] ?? 0);


$response = $reservationService->getUnavailableDates($id);

Response::json($response);
