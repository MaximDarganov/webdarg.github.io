<?php
require_once __DIR__ . "/DB/QueryBuilder.php";
require_once __DIR__ . "/helpers.php";

if (!empty($_POST)) {
    updateRequest(params(), $_POST["id"]);
    $_SESSION["success"] = "Данные о пользователе успешно изменены.";
}

if (
    empty($_SERVER["PHP_AUTH_USER"]) ||
    empty($_SERVER["PHP_AUTH_PW"]) ||
    $_SERVER["PHP_AUTH_USER"] != "admin" ||
    md5($_SERVER["PHP_AUTH_PW"]) != md5("secret")
) {
    header("HTTP/1.1 401 Unanthorized");
    header('WWW-Authenticate: Basic realm="My site"');
    print "<h1>401 Требуется авторизация</h1>";
    exit();
}

$requests = QueryBuilder::table("request")
    ->select("*, `users`.`login` as `login`")
    ->leftJoin("users", "user_id")
    ->result();

$countOfSuperpowers = QueryBuilder::getPdo()
    ->query(
        "select count(*) as `count`, name from 
                kubsu_backend_5.superpower_request 
                left join superpowers s on s.id = superpower_request.superpower_id
                group by superpower_id
        "
    )
    ->fetchAll(PDO::FETCH_OBJ);
?>
<?php require_once __DIR__ . "/layouts/header.php"; ?>
  <div class="container">
    <h1>Панель адимнистратора</h1>
      <div class="w-75 m-3 p-5 rounded border border-warning row">
        <h2>Статистика по успеваимости</h2>
        <?php foreach ($countOfSuperpowers as $superpower) { ?>
            <div class="w-25">
              Учебное заведение: <strong><?= $superpower->name ?></strong>
              <br>
              Количество троек: <strong><?= $superpower->count ?></strong>
            </div>
        <?php } ?>
      </div>
      <?php foreach ($requests as $request) { ?>
        <form method="post">
          <div class="mt-5 row">
              <?php foreach ($request as $field => $value) { ?>
                  <?php if ($field == "login") { ?>
                  <div class="alert-success rounded border border-success p-2" style="width: 200px;">
                    Введено пользователем: <?= $value ?>
                  </div>
                      <?php continue;} ?>
                  <?php if ($field == "password" || $field == "user_id") {
                      continue;
                  } ?>
                <div style="width: 150px;">
                  <label for="<?= $field ?>"><?= $field ?></label>
                  <input type="text"
                         name="<?= $field ?>"
                         id="<?= $field ?>"
                         class="form-control"
                         value="<?= $value ?>"
                  >
                </div>
              <?php } ?>
            <button type="submit" class="btn btn-success m-2" style="width: 100px;">Сохранить</button>
          </div>
        </form>
      <?php } ?>
  </div>
<?php require_once __DIR__ . "/layouts/footer.php"; ?>
