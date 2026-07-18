<?php

include_once __DIR__ . "/../services/SessionService.php";
include_once __DIR__ . "/../enum/Role.php";

class VisitorMiddleware
{
    public static function handle(bool $api = true): void
    {
        $session = new SessionService();
        $session->start();

        if (!$session->isAuthenticated()) {
            return;
        }

        if ($api) {
            Response::error("Already authenticated.", 403);
        }

        switch ($session->getRoleId()) {
            case Role::SUPER_ADMIN:
            case Role::ADMIN:
                header("Location: /hotel/Hotel-Reservation/admin/dashboard");
                break;

            case Role::CUSTOMER:
                header("Location: /hotel/Hotel-Reservation/customer/dashboard");
                break;

            default:
                header("Location: /hotel/Hotel-Reservation/");
        }

        exit;
    }
}
