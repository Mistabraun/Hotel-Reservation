<?php

require_once __DIR__ . "/../../app/helper/Response.php";
require_once __DIR__ . "/../../app/middleware/Authmidlleware.php";
require_once __DIR__ . "/../../app/services/ReservationService.php";

AuthMiddleware::user();
AuthMiddleware::method("GET");

$id = (int)($_GET["id"] ?? 0);

$reservationService = new ReservationService();

$response = $reservationService->getById($id);

Response::json($response);
