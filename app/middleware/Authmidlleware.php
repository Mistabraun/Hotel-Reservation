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

        header("Location: /login");
        exit;
    }

    public static function admin(bool $api = true): void
    {
        $session = self::session();

        if ($session->isAuthenticated()) {
            return;
        }

        if ($session->isAdmin()) {
            return;
        }

        if ($api) {
            Response::error("Unauthorized", 401);
        }

        header("Location: admin/login");
        exit;
    }
}
