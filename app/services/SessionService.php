<?php

class SessionService
{
    public function start(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }


    public function login(array $user): void
    {
        session_regenerate_id(true);

        $_SESSION["user"] = [
            "id"       => $user["id"],
            "username" => $user["username"],
            "email"    => $user["email"],
            "role_id"  => $user["role_id"]
        ];
    }

    public function logout(): void
    {
        $_SESSION = [];

        if (ini_get("session.use_cookies")) {

            $params = session_get_cookie_params();

            setcookie(
                session_name(),
                "",
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        session_destroy();
    }

    public function isAuthenticated(): bool
    {
        return isset($_SESSION["user"]);
    }

    public function getUser(): ?array
    {
        return $_SESSION["user"] ?? null;
    }

    public function getUserId(): ?int
    {
        return $_SESSION["user"]["id"] ?? null;
    }

    public function getRoleId(): ?int
    {
        return $_SESSION["user"]["role_id"] ?? null;
    }

    public function hasRole(int ...$roles): bool
    {
        return in_array(
            $this->getRoleId(),
            $roles,
            true
        );
    }

    public function redirectToDashboard(): never
    {
        switch ($this->getRoleId()) {
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
