<div class="container">
  <?php render('message.php', ['msg' => '$msg', 'msgClass' => 'alert-primary']) ?>
  <div class="row">
    <div class="col-3 admin-sidebar border-right">
      <h4>Категории</h4>
      <form class="mb-5">
          <div class="form-group">
            <label>Добавить категорию</label>
            <input class="form-control" type="text" name="name">
            <input type="hidden" name="category" value="add">
          </div>
          <button type="submit" class="btn btn-primary">Отправить</button>
      </form>
    </div>
    <div class="col-9 admin-content">
      <h4>Вопросы</h4>
    </div>
  </div>
</div>


