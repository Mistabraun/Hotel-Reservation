<?php

class Database
{
    private static ?mysqli $connection = null;

    public static function connect()
    {
        if (self::$connection) {
            return self::$connection;
        }

        self::$connection = mysqli_connect(
            "localhost",
            "root",
            "",
            "hotel"
        );
        if (!self::$connection) {
            die("Database connection failed! " . mysqli_connect_error());
        }
        return self::$connection;
    }
}
