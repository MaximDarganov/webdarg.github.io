<?php

require_once "DB/QueryBuilder.php";

class DB extends QueryBuilder
{
    public function insert(array $values, string $table): bool
    {
        $stmt = $this->pdo->prepare(
            "insert into $table (name, email, birthday, sex, count_hands, bio, user_id) 
            values (:name, :email, :birthday, :sex, :count_hands, :bio, :user_id);"
        );

        $values["user_id"] = $_SESSION["user"]->getId();

        return $stmt->execute($values);
    }

    public function insertIntoPivot(string $firstId, string $secondId): bool
    {
        $stmt = $this->pdo->prepare(
            'insert into superpower_request (request_id, superpower_id)
            values (?, ?)'
        );

        return $stmt->execute([$firstId, $secondId]);
    }

    public function maxRequestId()
    {
        return $this->pdo
            ->query("select id from request order by id desc")
            ->fetch()[0];
    }

    public function getSuperpowers(): bool|array
    {
        return $this->pdo->query("select * from superpowers")->fetchAll();
    }
}
