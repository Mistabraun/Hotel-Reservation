<?php

include_once __DIR__ . "/../app/services/AuthService.php";
include_once __DIR__ . "/../app/helper/Response.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    Response::error("Method is not allowed.");
}

$authService = new AuthService();
$result = $authService->login($_POST);

if (!$result) {
    Response::error($result["message"], 401);
}

Response::json($result);
