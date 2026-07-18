<?php

require_once __DIR__ . "/../../app/middleware/Authmidlleware.php";

AuthMiddleware::admin();

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    Response::error("Invalid type of method", 405);
}

$roomService = new RoomService();

$result = $roomService->create($_POST);

Response::json($result);
