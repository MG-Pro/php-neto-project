<div class="container">
  <div class="col">
    <h4 class="mb-3 mt-2">Изменить пароль админстратора</h4>
    <form class="mb-5 col-5" action="index.php" method="post">
      <div class="form-group">
        <label>Логин</label>
        <input class="form-control" type="text" name="login" value="<?php echo $login?>" disabled>
      </div>
      <div class="form-group">
        <label>Старый пароль</label>
        <input type="text" name="old-pas" class="form-control">
      </div>
      <div class="form-group">
        <label>Новый пароль</label>
        <input type="text" name="new-pas" class="form-control">
      </div>
      <div class="form-group">
        <label>Повторите пароль</label>
        <input type="text" name="new-pas2" class="form-control">
      </div>
      <input type="hidden" name="login" value="<?php echo $login?>">
      <input type="hidden" name="admin" value="edit-pass">
      <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
  </div>
</div>

