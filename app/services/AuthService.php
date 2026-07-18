<?php

include_once __DIR__ . "/../models/User.php";
include_once __DIR__ . "/SessionService.php";
include_once __DIR__ . "/BaseService.php";

class AuthService extends BaseService
{
    private User $user;
    private SessionService $session;

    public function __construct()
    {
        $this->user = new User();
        $this->session = new SessionService();
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
        if (!$userData) {
            return $this->error("User does not exist. ");
        }

        if (!$userData || !password_verify($password, $userData["password"])) {
            return  $this->error("Invalid Credentials");
        }


        $this->session->login($userData);

        $result = [
            "success" => true,
            "message" => "Logged in successfully.",
        ];

        if ($this->session->isAdmin()) {
            $result["admin"] = true;
        }

        return $result;
    }
}
