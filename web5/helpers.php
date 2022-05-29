<?php

    function checkLogin(): void {
        if (!empty($_POST['login'])) {
            $user = QueryBuilder::table('users')
                ->select('*')
                ->where('login', $_POST['login'])
                ->limit(1)
                ->first();

            if (password_verify($_POST['password'], $user->password)) {
                $_SESSION['auth'] = true;
                $_SESSION['user'] = $user;
            } else {
                $_SESSION['auth'] = false;
            }
        }
    }

    function updateRequest(array $params) {
        $userId = user()->id;
        QueryBuilder::getPdo()
            ->prepare("
                update `request` 
                set name=:name,
                email=:email,
                birthday=:birthday,
                sex=:sex,
                count_hands=:count_hands,
                bio=:bio
                where user_id=$userId
            ")->execute($params);
    }

    function isAuthenticated(): bool {
        return !empty($_SESSION['auth']);
    }

    function session(string $key) {
        return $_SESSION[$key] ?? '';
    }

    function user(): object {
        return session('user');
    }

    function params() {
        return array_diff_key($_POST, array_flip(['superpowers', 'check']));
    }

    function createRequest(DB $db, Validator $validator, array $params): void {
        if (!empty($_POST) && empty($_POST['login'])) {

            $validator->validate($params);
            if ($validator->fails()) {
                header('Location: /');
                die();
            }

            $_SESSION['success'] = 'Успешно';

            $rand = rand(1, 1000);
            $login = "login" . $rand . "@example.com";
            $rawPassword = "password$rand";
            $password = password_hash($rawPassword, null);
            $user = new User($login, $password);
            $user->create();
            $user->rawPassword = $rawPassword;

            $_SESSION['user'] = $user;

            $db->insert($params, 'request');

            $id = $db->maxRequestId();

            if (isset($_POST['superpowers'])) {
                foreach ($_POST['superpowers'] as $superpowerId) {
                    $db->insertIntoPivot($id, $superpowerId);
                }
            }
        }
    }