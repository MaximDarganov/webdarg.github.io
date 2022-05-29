<?php
session_start();
ini_set("display_errors", 1);

require_once __DIR__ . "/DB/QueryBuilder.php";
require_once __DIR__ . "/DB.php";
require_once __DIR__ . "/Validator.php";
require_once __DIR__ . "/DB/User.php";
require_once __DIR__ . "/helpers.php";

$db = new DB();
$validator = new Validator();

isAuthenticated()
    ? updateRequest(params())
    : createRequest($db, $validator, params());

checkLogin();
?>

<?php require_once __DIR__ . "/layouts/header.php"; ?>
<a href="/admin.php" class="btn btn-outline-danger m-3">
  Войти как администратор
</a>

<div class="container w-50" style="margin-top: 100px">
    <?php
    require_once __DIR__ . "/form.php";
    require_once __DIR__ . "/login.php";
    ?>
    <?php if (!empty($_COOKIE["errors"])) {
        $validator->unsetCookies();
    } ?>
</div>

<?php require_once __DIR__ . "/layouts/footer.php"; ?>
