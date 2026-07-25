<?php

require_once __DIR__ . "/../../../app/helper/Response.php";
require_once __DIR__ . "/../../../app/middleware/Authmidlleware.php";

require_once __DIR__ . "/../../../app/services/TransactionService.php";

AuthMiddleware::method("GET");
$userId = AuthMiddleware::user();

$service = new TransactionService();

Response::json(
    $service->getTransactions(
        $userId
    )
);
