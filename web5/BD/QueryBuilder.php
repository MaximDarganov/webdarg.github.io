<?php

class QueryBuilder
{
    protected $pdo;

    protected $query;

    protected $table;

    public function __construct()
    {
        $user = "homestead";
        $pass = "secret";
        $this->pdo = new PDO(
            "mysql:host=localhost;dbname=kubsu_backend_5",
            $user,
            $pass
        );
        $this->query = "";
    }

    public static function table(string $table): self
    {
        $instance = new static();
        $instance->table = $table;

        return $instance;
    }

    public static function getPdo()
    {
        return (new static())->pdo;
    }

    public static function insertRaw(string $query): int
    {
        $instance = new static();
        $instance->pdo->query($query);

        return $instance->pdo->lastInsertId();
    }

    public static function query(): self
    {
        return new static();
    }

    public function select(string $columns): self
    {
        $this->query = "select $columns from $this->table";
        return $this;
    }

    public function where(string $name, mixed $value): self
    {
        $this->query .= " where $name = '$value'";
        return $this;
    }

    public function and(object $param): self
    {
        $this->query .= " and $param->name = $param->value";
        return $this;
    }

    public function limit(int $limit): self
    {
        $this->query .= " limit $limit";
        return $this;
    }

    public function result(): array
    {
        return $this->pdo->query($this->query)->fetchAll(PDO::FETCH_OBJ);
    }

    public function first(string $class = null)
    {
        return $this->pdo->query($this->query)->fetchObject();
    }
}
