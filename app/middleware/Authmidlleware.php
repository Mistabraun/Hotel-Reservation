<?php
include_once __DIR__ . "/../services/SessionService.php";
include_once __DIR__ . "/../enum/Role.php";

class AuthMiddleware
{
    private static function session(): SessionService
    {
        $session = new SessionService();
        $session->start();

        return $session;
    }

    public static function guest(bool $api = true): void
    {
        $session = self::session();

        if (!$session->isAuthenticated()) {
            return;
        }

        if ($api) {
            Response::error("Already authenticated.", 403);
        }

        $session->redirectToDashboard();
    }

    public static function user(bool $api = true): void
    {
        $session = self::session();

        if ($session->isAuthenticated()) {
            return;
        }

        if ($api) {
            Response::error("Unauthorized", 401);
        }

        header("Location: /hotel/Hotel-Reservation/login");
        exit;
    }

    public static function role(array $roles, bool $api = true): void
    {
        self::user($api);

        $session = self::session();

        if ($session->hasRole(...$roles)) {
            return;
        }

        if ($api) {
            Response::error("Forbidden", 403);
        }

        header("Location: /hotel/Hotel-Reservation/403");
        exit;
    }

    public static function admin(bool $api = true): void
    {
        self::role([
            Role::SUPER_ADMIN,
            Role::ADMIN
        ], $api);
    }

    public static function customer(bool $api = true): void
    {
        self::role([
            Role::CUSTOMER
        ], $api);
    }
}
