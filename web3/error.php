<?php if (!empty($_SESSION['errors'])) { ?>
<div class="container">
  <div class="w-25 alert-warning p-3 m-4 bordered border-warning rounded">
      <?php foreach ($_SESSION['errors'] as $error) {
          echo $error . '<br>';
      } ?>
  </div>
</div>
<?php }
$_SESSION['errors'] = null;
?>