<?php

require_once __DIR__ . "/../../app/middleware/Authmidlleware.php";
require_once __DIR__ . "/../../app/services/RoomService.php";
require_once __DIR__ . "/../../app/helper/Response.php";

AuthMiddleware::admin();

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    Response::error("Invalid type of method", 405);
}

$roomService = new RoomService();

$result = $roomService->create($_POST);

if ($result["success"]) {
    return Response::success($result["message"]);
}

return Response::error($result["message"], 400);
