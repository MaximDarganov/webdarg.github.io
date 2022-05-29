<?php

    class Validator
    {
        protected $fails = false;

        protected $rules = [
            'email' => 'email',
            'count_hands' => '/[0-9]/',
            'birthday' => '/\d{4}/',
            'name' => '/[a-zA-Z]+/',
            'bio' => '/.+/',
        ];

        protected $messages = [
            'birthday' => 'Дата рождения должна быть числом из 4 цифр',
            'bio' => 'Биография не должен быть пустым',
            'name' => 'Имя должен содержать только символы',
            'email' => 'Адрес электронной почты должен быть валидным адресом',
        ];

        public function validate(array $params) {
            foreach ($params as $param => $value) {
                $name = $this->messages[$param] ?? '';
                $_SESSION[$param] = $value;
                if (!$this->match($param, $value)) {
                    setcookie("errors[$param]", "Параметр $name ");
                    $this->fails = true;
                    continue;
                } else {
                    setcookie("success[$param]", $value, time() + 60 * 60 * 24 * 365);
                }

                if ($this->isEmail($param)) {
                    if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                        setcookie("errors[$param]", "Параметр $name");
                        $this->fails = true;
                    }
                }

            }

            if (!$this->fails) {
                setcookie('success', 'Успешно!');
            }
        }

        protected function match(string $name, string $value): bool {
            if (!isset($this->rules[$name]) || $this->isEmail($name)) {
                return true;
            }

            return preg_match($this->rules[$name], $value);
        }

        public function fails(): bool {
            return $this->fails;
        }

        protected function isEmail($param): bool {
            return isset($this->rules[$param]) && $this->rules[$param] == 'email';
        }

        public function unsetCookies() {
            foreach ($_COOKIE['errors'] as $key => $error) {
                setcookie("errors[$key]", '');
            }

            foreach ($_COOKIE['success'] as $key => $success) {
                setcookie("success[$key]", '');
            }
        }

        public static function hasErrorCookie(string $key) {
            return !empty($_COOKIE["errors"][$key]);
        }

        protected static function hasOldInput(string $key): bool {
            return !empty($_SESSION[$key]);
        }

        protected static function hasSuccessCookie(string $key): bool {
            return !empty($_COOKIE["success"][$key]);
        }

        public static function showOldInput(string $key) {
            if (!empty($_SESSION['auth']) && !empty($_SESSION['user'])) {
                $request = QueryBuilder::getPdo()
                    ->query('select * from request where user_id = ' . $_SESSION['user']->id)
                    ->fetchObject();
                echo $request->$key;
            }

            echo '';
        }
    }