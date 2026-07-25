<?php

require_once __DIR__ . "/../../app/helper/Response.php";
require_once __DIR__ . "/../../app/middleware/Authmidlleware.php";
require_once __DIR__ . "/../../app/services/ReportService.php";

AuthMiddleware::method("GET");

$reportService = new ReportService();

Response::json(
    $reportService->getPerformanceOverview()
);
