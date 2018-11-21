<div class="container">
  <div class="row">
    <div class="content col-5 mt-5 align-self-center ml-auto mr-auto">
      <h4 class="text-center">Форма регистрации администратора</h4>
      <hr>
      <form class="mb-2" action="index.php" method="post">
        <div class="form-group">
          <label for="login">Логин</label>
          <input type="text" name="login" class="form-control" id="login">
        </div>
        <div class="form-group">
          <label for="pas">Пароль</label>
          <input type="text" name="pas" class="form-control" id="pas">
        </div>
        <div class="form-group">
          <label for="pas2">Повторите пароль</label>
          <input type="text" name="pas2" class="form-control" id="pas2">
        </div>
        <input type="hidden" name="admin" value="signup">
        <button type="submit" class="btn btn-primary">Отправить</button>
      </form>
      <div class="text-center mb-2">
        <a class="badge badge-success" href="index.php?admin=signin">Авторизация</a>
      </div>
    </div>
  </div>
</div>
