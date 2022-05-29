<?php
    session_start();
    ini_set('display_errors', 1);

    require_once __DIR__ . '/DB/QueryBuilder.php';
    require_once __DIR__ . '/DB.php';
    require_once __DIR__ . '/Validator.php';
    require_once __DIR__ . '/DB/User.php';
    require_once __DIR__ . '/helpers.php';

    $db = new DB();
    $validator = new Validator();

    isAuthenticated() ?
        updateRequest(params()) :
        createRequest($db, $validator, params());

    checkLogin();

?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>5 Задание</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<?php if (!empty($_SESSION['success'])) { ?>
  <div class="container">
    <div class="w-25 alert-success p-3 m-4 bordered border-success rounded">
        <?= $_SESSION['success']; ?>
      <br>
        <?php if (isset($_SESSION['user'])) { ?>
            <?= "Логин: " . user()->getLogin() . "<br>Пароль: " . user()->rawPassword ?>
        <?php } ?>
    </div>
  </div>
    <?php
    $_SESSION['success'] = null;
} ?>
<?php require_once __DIR__ . '/errors.php' ?>
<div class="container w-50" style="margin-top: 100px">
    <?php
        require_once __DIR__ . '/form.php';
        require_once __DIR__ . '/login.php';
    ?>
    <?php if (!empty($_COOKIE['errors'])) {
        $validator->unsetCookies();
    } ?>
</div>
</body>
</html>