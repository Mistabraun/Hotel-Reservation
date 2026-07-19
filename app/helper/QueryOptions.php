<?php

class QueryOptions
{
    public int $page;
    public int $limit;
    public int $offset;

    public string $search;
    public string $filter;

    public static function fromArray(array $query): self
    {
        $instance = new self();

        $instance->page = max(
            1,
            (int)($query["page"] ?? 1)
        );

        $instance->limit = max(
            1,
            min((int)($query["limit"] ?? 10), 100)
        );

        $instance->offset =
            ($instance->page - 1) * $instance->limit;

        $instance->search = trim(
            $query["search"] ?? ""
        );

        $instance->filter = strtolower(
            trim($query["filter"] ?? "all")
        );

        return $instance;
    }
}
