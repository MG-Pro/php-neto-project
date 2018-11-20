<div class="container">
  <div class="row">
    <div class="col ">
      <ul class="nav border-bottom">
        <li class="nav-item">
          <a class="nav-link" href="index.php?admin=admin-list">Администраторы</a>
        </li>
      </ul>
    </div>
  </div>
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


