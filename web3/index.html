<?php
session_start();
require_once __DIR__ . '/DB.php';
require_once __DIR__ . '/Validator.php';

$validator = new Validator();
$db = new DB();

if (!empty($_POST)) {
    $params = array_diff_key($_POST, array_flip(['superpowers', 'check']));

    $validator->validate($params);
    if ($validator->fails()) {
      header('Location: /');
      die();
    }

    $db->insert($params, 'request');
    $id = $db->maxRequestId();
    if (isset($_POST['superpowers'])) {
        foreach ($_POST['superpowers'] as $superpowerId) {
            $db->insertIntoPivot($id, $superpowerId);
        }
    }
}

?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>3 Задание</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<?php require_once __DIR__ . '/errors.php' ?>
<div class="container w-50" style="margin-top: 100px">
    <?php require_once __DIR__ . '/form.php' ?>
</div>
</body>
</html>
