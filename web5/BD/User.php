<?php

require_once "QueryBuilder.php";

class User extends QueryBuilder
{
    public $rawPassword;

    public $id;

    public function __construct(
        protected string $login,
        protected string $password
    ) {
        parent::__construct();
    }

    public function create()
    {
        $this->id = QueryBuilder::insertRaw("
                insert into `users` (`login`, `password`) 
                values ('$this->login', '$this->password')
            ");
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
