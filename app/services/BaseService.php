<?php

abstract class BaseService
{
    protected function success(
        mixed $message,
        mixed $data = null
    ): array {

        $response = [
            "success" => true,
            "message" => $message
        ];

        if ($data) {
            $response["data"] = $data;
        }

        return $response;
    }

    protected function error(string $message)
    {
        return [
            "success" => false,
            "message" => $message
        ];
    }
}
