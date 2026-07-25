<?php

require_once __DIR__ . "/../../app/helper/Response.php";
require_once __DIR__ . "/../../app/middleware/Authmidlleware.php";
require_once __DIR__ . "/../../app/services/StayService.php";

AuthMiddleware::method("POST");

$reservationId = (int)($_POST["reservation_id"] ?? 0);

$stayService = new StayService();

Response::json(
    $stayService->checkIn($reservationId)
);
