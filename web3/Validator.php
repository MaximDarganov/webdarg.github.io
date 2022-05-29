<?php

class Validator
{
    protected bool $fails = false;

    protected array $rules = [
        "email" => "email",
    ];

    protected array $messages = [
        "count_hands" => "Как дела?",
        "birthday" => "Дата рождения",
        "sex" => "Ваш Пол",
        "bio" => "Биография",
        "name" => "Имя",
        "email" => "Адрес электронной почты",
    ];

    public function validate(array $params)
    {
        foreach ($params as $param => $value) {
            $name = $this->messages[$param];
            if (!$value) {
                $_SESSION["errors"][] = "Параметр $name должен быть заполнен.";
                $this->fails = true;
                continue;
            }

            if ($this->isEmail($param)) {
                if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $_SESSION["errors"][] = "Параметр $name должен быть валидным адресом.";
                    $this->fails = true;
                }
            }
        }
    }

    public function fails(): bool
    {
        return $this->fails;
    }

    protected function isEmail($param): bool
    {
        return isset($this->rules[$param]) && $this->rules[$param] == "email";
    }
}
