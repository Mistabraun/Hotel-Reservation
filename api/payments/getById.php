<?php
require_once __DIR__ . "/../../app/middleware/Authmidlleware.php";
require_once __DIR__ . "/../../app/services/PaymentService.php";
require_once __DIR__ . "/../../app/helper/Response.php";

AuthMiddleware::method("GET");

$id = (int)($_GET["id"] ?? 0);

$service = new PaymentService();

$result = $service->getById($id);

if (!$result["success"]) {
    Response::error($result["message"], 404);
}

Response::json($result);
