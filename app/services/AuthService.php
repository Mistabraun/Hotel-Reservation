<?php

include_once __DIR__ . "/../models/User.php";
include_once __DIR__ . "/SessionService.php";

class AuthService
{
    private User $user;
    private SessionService $session;

    public function __construct()
    {
        $this->user = new User();
        $this->session = new SessionService();
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

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->error("Invalid Credentials");
        }

        $userData = $this->user->findByEmail($email);

        if (!$userData || !password_verify($password, $userData["password"])) {
            return  $this->error("Invalid Credentials");
        }


        $this->session->login($userData);

        return [
            "success" => true,
            "message" => "Logged in successfully."
        ];
    }
}
