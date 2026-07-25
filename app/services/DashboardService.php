<?php

require_once __DIR__ . "/BaseService.php";
require_once __DIR__ . "/../models/Dashboard.php";

class DashboardService extends BaseService
{
    private Dashboard $dashboard;

    public function __construct()
    {
        $this->dashboard = new Dashboard();
    }

    public function getSummary(): array
    {
        return $this->success(
            "Dashboard summary retrieved successfully.",
            [
                "rooms" => [
                    "total" => $this->dashboard->countRooms(),
                    "available" => $this->dashboard->countAvailableRooms(),
                    "occupied" => $this->dashboard->countOccupiedRooms(),
                    "maintenance" => $this->dashboard->countMaintenanceRooms()
                ],

                "reservations" => [
                    "today" => $this->dashboard->countTodayReservations(),
                    "arrivals" => $this->dashboard->countExpectedCheckIns(),
                    "departures" => $this->dashboard->countExpectedCheckOuts()
                ],

                "revenue" => [
                    "month" => $this->dashboard->getMonthlyRevenue()
                ],
                "charts" => [
                    "occupancy" => $this->dashboard->getWeeklyOccupancy(),
                    "monthly_revenue" => $this->dashboard->getMonthlyRevenueChart()
                ]
            ]
        );
    }
}
