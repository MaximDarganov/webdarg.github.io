<?php if (!empty($_COOKIE['errors'])) { ?>
  <div class="container">
    <div class="w-25 alert-warning p-3 m-4 bordered border-warning rounded">
        <?php foreach ($_COOKIE['errors'] as $key => $error) {
            echo $error . '<br>';
        } ?>
    </div>
  </div>
<?php } ?>