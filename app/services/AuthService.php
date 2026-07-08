<?php

include_once __DIR__ . "/../models/User.php";

class AuthService
{
    private User $user;

    public function __construct()
    {
        $this->user = new User();
    }

    private function error(String $message)
    {
        return [
            "success" => false,
            "message" => $message
        ];
    }

    public function login(array $credentials)
    {
        $email = trim($credentials["email"] ?? "");
        $password = $credentials["password"] ?? "";

        if (empty($email) || empty($password)) {
            return $this->error("Username and password is required.");
        }

        if (strlen($password) <= 6 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->error("Invalid Credentials");
        }

        $userData = $this->user->findByEmail($email);

        if (!$userData || !password_verify($password, $userData["password"])) {
            return  $this->error("Invalid Credentials");
        }

        return [
            "success" => true,
            "message" => [
                "id" => $userData["id"],
                "username" => $userData["username"],
                "email" => $userData["email"],
                "role" => $userData["role"]
            ]
        ];
    }
}
