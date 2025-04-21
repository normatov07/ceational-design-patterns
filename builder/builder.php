<?php

interface Builder
{
    public function toSql(): string;
    public function where(string $column, string $operator, string $value): self;
    public function select(...$selects): self;
    public static function table(string $table): self;
    public function orderBy(string $column, string $type = "ASC"): self;
    public function groupBy(...$columns): self;
    public function limit(int $limit, int $offset = 0): self;
    public function get(): array;
    public function first(): array;
}

class MysqlBuilder implements Builder
{

    public function toSql(): string 
    {

        return "";
    }
    public function where(string $column, string $operator, string $value): self
    {

        return $this;
    }
    public function select(...$selects): self 
    {


        return $this;

    }
    public static function table(string $table): self
    {

        return new self();
    }
    public function orderBy(string $column, string $type = "ASC"): self
    {

        return $this;
    }
    public function groupBy(...$columns): self
    {

        return $this;
    }

    public function get(): array
    {

        return [];
    }

    public function first(): array
    {

        return [];
    }

    public function limit(int $limit, int $offset = 0): self
    {

        return new self();
    }
}

// Client implementation
class Post {
    protected Builder $builder;

    public function __construct()
    {       
        $this->builder = new MysqlBuilder();
    }

    public  function getPosts(string $search): array {
        return $this->builder->table("posts")->select("id", "title", "content")
            ->where("title", "LIKE", $search)
            ->limit(10, 0)
            ->get();
    }
}