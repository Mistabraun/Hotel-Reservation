<?php

class Pagination
{
    public static function create(
        array $items,
        QueryOptions $options,
        int $total
    ): array {

        return [
            "items" => $items,

            "pagination" => [

                "page" => $options->page,

                "limit" => $options->limit,

                "total_records" => $total,

                "total_pages" => max(
                    1,
                    ceil($total / $options->limit)
                ),

                "has_previous" =>
                $options->page > 1,

                "has_next" =>
                $options->page * $options->limit < $total
            ]
        ];
    }
}
