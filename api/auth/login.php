<?php

include_once __DIR__ . "/../../app/services/AuthService.php";
include_once __DIR__ . "/../../app/helper/Response.php";
include_once __DIR__ . "/../../app/middleware/Authmidlleware.php";

AuthMiddleware::guest();


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $authService = new AuthService();
    $result = $authService->login($_POST);


    if (!$result) {
        Response::error($result["message"], 401);
    }

    Response::json($result);
}

Response::error("Invalid type of method.");
