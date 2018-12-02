<div class="container">
  <div class="col">
    <h4 class="mb-3 mt-2">Подтверждение удаления категории</h4>
    <div class="jumbotron jumbotron-fluid">
      <div class="container">
        <h3 class="display-4">Внимание!</h3>
        <p class="lead">Тема <?php echo $title ?> содержит <?php echo $count ?> вопросов. Все они будут
          удалены.</p>
        <p class="lead">Вы уверены?</p>
        <div class="row">
          <div class="col text-center">
            <a class="btn btn-primary mr-4" href="index.php?admin=admin-categories&sortBy=title&dir=desc">Отмена</a>
            <form action="index.php" method="post" class="d-inline-block">
              <input type="hidden" name="category" value="delete">
              <input type="hidden" name="id" value="<?php echo $id ?>">
              <input type="hidden" name="need-confirm" value="0">
              <button type="submit" class="btn btn-danger">Удалить</button>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>

