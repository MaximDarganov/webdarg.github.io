<form class="form" action="" method="post">
	<h2>Имя:</h2> <input type="text" value="<?php Validator::showOldInput('name') ?>" name="name" class="form-control <?php if (Validator::hasErrorCookie('name')) echo 'is-invalid' ?>" placeholder="Name:"><br>
	<h2>E-mail:</h2> <input type="text" value="<?php Validator::showOldInput('email'); ?>" class="form-control <?php if (Validator::hasErrorCookie('email')) echo 'is-invalid' ?>" name="email" placeholder="email@mail.ru"><br>
	<h2>Year:</h2> <input type="text" class="form-control <?php if (Validator::hasErrorCookie('birthday')) echo 'is-invalid' ?>" name="birthday" value="<?php Validator::showOldInput('birthday'); ?>"><br>
	<h2>Gender:</h2> <label for="sex">
    <input type="radio"
           checked="checked"
           id="male"
           name="sex"
           value="Мужской"/>Мужской
  </label><br> <label for="female">
    <input type="radio"
           id="female"
           name="sex"
           value="Женский"/>Женский
  </label><br>
	<h2>Количество конечностей:</h2> <label for="four">
    <input type="radio" checked="checked"
           name="count_hands" value="4" id="four"/>Четыре
  </label><br> <label for="five">
    <input type="radio"
           name="count_hands" value="5" id="five"/>Пять
  </label><br>
	<h2>Super Powers: </h2> <select name="superpowers[]" size="3" class="form-control" multiple="multiple">
      <?php foreach ($db->getSuperpowers() as $superpower) { ?>
        <option value="<?= $superpower['id'] ?>"><?= $superpower['name'] ?></option>
      <?php } ?>
  </select> <br>
	<h2>Биография</h2> <textarea name="bio" class="form-control
    <?php if (Validator::hasErrorCookie('bio')) echo 'is-invalid'
  ?>"></textarea> <br> <label for="agree">
    <input type="checkbox" required
           name="check" id="agree">С контрактом ознакомлен(а)
  </label><br> <input type="submit" value="Отправить" class="btn btn-success"> </form>