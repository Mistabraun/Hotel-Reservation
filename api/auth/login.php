<?php

include_once __DIR__ . "/../../app/services/AuthService.php";
include_once __DIR__ . "/../../app/helper/Response.php";
include_once __DIR__ . "/../../app/middleware/Authmidlleware.php";
include_once __DIR__ . "/../../app/enum/Role.php";

AuthMiddleware::admin();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $authService = new AuthService();
    $result = $authService->login($_POST);

    if (!$result) {
        Response::error($result["message"], 401);
    }

    Response::json($result);
}

Response::error("Method is not allowed.");
