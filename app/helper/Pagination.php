<?php

class Pagination
{
    public static function create(
        array $items,
        int $page,
        int $limit,
        int $total
    ): array {

        return [
            "items" => $items,
            "pagination" => [
                "page" => $page,
                "limit" => $limit,
                "total_records" => $total,
                "total_pages" => (int) ceil($total / $limit),
                "has_previous" => $page > 1,
                "has_next" => $page * $limit < $total
            ]
        ];
    }
}
    