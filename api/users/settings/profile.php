<?php

require_once __DIR__ . "/../../../app/helper/Response.php";
require_once __DIR__ . "/../../../app/middleware/Authmidlleware.php";
require_once __DIR__ . "/../../../app/services/CustomerProfileService.php";

AuthMiddleware::method("POST");

$user = AuthMiddleware::user();

$service = new CustomerProfileService();



Response::json(
    $service->update(
        $user,
        $_POST
    )
);
