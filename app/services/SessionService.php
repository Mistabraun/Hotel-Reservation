<?php

include_once __DIR__ . "/../enum/Role.php";

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
            "email"    => $user["email"],
            "role_id"  => $user["role_id"]
        ];
    }

    public function logout(): void
    {
        $this->start();
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

    public function isAdmin(): bool
    {
        return $this->getRoleId() == Role::ADMIN->value;
    }

    public function hasRole(int ...$roles): bool
    {
        return in_array(
            $this->getRoleId(),
            $roles,
            true
        );
    }

    public function redirectToDashboard(): void
    {
        switch ($this->getRoleId()) {
            case Role::ADMIN:
                header("Location: /../admin/dashboard.php");
                break;

            default:
                header("Location: ../admin/dashboard.php");
        }
    }
}
