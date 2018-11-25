<div class="container">
  <div class="col">
    <h4 class="mb-3 mt-2">Переименовать категорию</h4>
    <form class="mb-5 form-inline" action="index.php" method="post">
      <div class="form-group mr-2">
        <input class="form-control" type="text" name="title" value="<?php echo $title?>">
        <input type="hidden" name="category" value="rename">
        <input type="hidden" name="id" value="<?php echo $id?>">
      </div>
      <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
  </div>
</div>



