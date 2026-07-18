<?php

abstract class BaseService
{
    protected function success(
        mixed $message
    ): array {

        $response = [
            "success" => true,
            "message" => $message
        ];


        return $response;
    }

    protected function error(string $message): array
    {
        return [
            "success" => false,
            "message" => $message
        ];
    }
}
