<?php

require_once __DIR__ . "/../../app/middleware/Authmidlleware.php";
require_once __DIR__ . "/../../app/services/RoomService.php";
require_once __DIR__ . "/../../app/helper/Response.php";

AuthMiddleware::admin();
AuthMiddleware::method("POST");

$roomService = new RoomService();

$result = $roomService->create($_POST, $_FILES);

if ($result["success"]) {
    return Response::success($result["message"]);
}

return Response::error($result["message"], 400);
