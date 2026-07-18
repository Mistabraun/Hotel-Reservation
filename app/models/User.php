<?php

require_once __DIR__ . "/../../config/Database.php";

class User
{
    private mysqli $connection;

    public function __construct()
    {
        $this->connection = Database::connect();
    }

    public function findByEmail(String $email)
    {
        $sql = "SELECT * FROM users WHERE email LIKE ?";
        $statement = mysqli_prepare($this->connection, $sql);
        mysqli_stmt_bind_param($statement, "s", $email);
        mysqli_stmt_execute($statement);

        $result = mysqli_stmt_get_result($statement);
        return mysqli_fetch_assoc($result) ?: null;
    }
}
