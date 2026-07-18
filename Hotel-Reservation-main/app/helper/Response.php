<?php

class Response
{

    public static function error(String | array $message, $status_code = 400)
    {
        return self::json([
            "success" => false,
            "message" => $message
        ]);
    }

    public static function success(String | array $message, $status_code = 400)
    {
        return self::json([
            "success" => true,
            "message" => $message
        ]);
    }

    public static function json(array $response, $status_code = 200)
    {
        http_response_code($status_code);
        header("Content-Type: application/json");

        echo json_encode($response);
        exit;
    }
}
