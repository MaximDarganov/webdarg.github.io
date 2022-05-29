<form class="form" action="#" method="post">
    <h2>Имя:</h2>
    <input type="text"
           name="name"
           class="form-control"
           placeholder="Name:"><br>
    <h2>E-mail:</h2>
    <input type="text"
           class="form-control"
           name="email"
           placeholder="email@mail.ru"><br>
    <h2>Date:</h2>
    <input type="date"
           class="form-control"
           name="birthday"
           value="2020-10-12"><br>
    <h2>Gender:</h2>
    <label for="sex">
        <input type="radio"
               checked="checked"
               id="male"
               name="sex"
               value="Мужской"/>Мужской
    </label><br>
    <label for="female">
        <input type="radio"
               id="female"
               name="sex"
               value="Женский"/>Женский
    </label><br>
    <h2>Количество конечностей:</h2>
    <label for="four">
        <input type="radio" checked="checked"
               name="count_hands" value="4" id="four"/>Четыре
    </label><br>
    <label for="five">
        <input type="radio"
               name="count_hands" value="5" id="five"/>Пять
    </label><br>
    <h2>Super Powers: </h2>
    <select name="superpowers[]"
            size="3"
            class="form-control"
            multiple="multiple">
      <?php foreach ($db->getSuperpowers() as $superpower) { ?>
        <option value="<?= $superpower['id'] ?>"><?= $superpower['name'] ?></option>
      <?php } ?>
    </select>
    <br>
    <h2>Биография</h2>
    <textarea name="bio"></textarea>
    <br>
    <label for="agree">
        <input type="checkbox" required
               name="check" id="agree">С контрактом ознакомлен(а)
    </label><br>
    <input type="submit" value="Отправить" class="btn btn-success">
</form>