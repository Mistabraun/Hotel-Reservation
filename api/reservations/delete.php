<?php

require_once __DIR__ . "/../../app/helper/Response.php";
require_once __DIR__ . "/../../app/middleware/Authmidlleware.php";
require_once __DIR__ . "/../../app/services/ReservationService.php";

AuthMiddleware::user();
AuthMiddleware::method("POST");

$id = (int)($_POST["id"] ?? 0);

$reservationService = new ReservationService();

$response = $reservationService->delete($id);

Response::json($response);
