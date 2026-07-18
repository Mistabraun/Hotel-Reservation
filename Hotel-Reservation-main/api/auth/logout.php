<?php

include_once __DIR__ . "/../../app/services/SessionService.php";
include_once __DIR__ . "/../../app/middleware/Authmidlleware.php";
include_once __DIR__ . "/../../app/helper/Response.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    Response::error("Invalid type of method.", 405);
}

AuthMiddleware::user();

$session = new SessionService();
$session->logout();
Response::success("Logged out successfully.");
