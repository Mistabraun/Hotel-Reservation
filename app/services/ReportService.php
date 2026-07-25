<?php

require_once __DIR__ . "/BaseService.php";
require_once __DIR__ . "/../models/Report.php";

class ReportService extends BaseService
{
    private Report $report;

    public function __construct()
    {
        $this->report = new Report();
    }

    public function getPerformanceOverview(): array
    {
        return $this->success(
            "Performance overview retrieved successfully.",
            $this->report->getPerformanceOverview()
        );
    }
}
