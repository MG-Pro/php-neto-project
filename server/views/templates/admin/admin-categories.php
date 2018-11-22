<div class="container">
  <div class="row">
    <div class="col">
      <h4 class="mb-3 mt-2">Категории</h4>
      <hr>
      <h6>Добавить категорию</h6>
      <form class="mb-5 form-inline" action="index.php" method="post">
        <div class="form-group mr-2">
          <input class="form-control" type="text" name="title" placeholder="Имя">
          <input type="hidden" name="category" value="add">
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
      </form>
      <?php if (count($categoriesList) > 0): ?>
        <table class="table table-striped table-hover text-center">
          <thead class="thead-light">
          <tr>
            <th scope="col">
              <a href="index.php?admin=admin-categories&sortBy=title&dir=<?php echo $dir?>">Имя</a>
            </th>
            <th scope="col">
              <a href="index.php?admin=admin-categories&sortBy=que">Вопросы</a>
            </th>
            <th scope="col">
              <a href="index.php?admin=admin-categories&sortBy=ans">Ответы</a>
            </th>
            <th scope="col">Действия</th>
          </tr>
          </thead>
          <tbody>
          <?php foreach ($categoriesList as $item): ?>
            <tr>
              <?php foreach ($item as $key => $value): ?>
              <?php if ($key !== 'id'): ?>
                <td>
                  <?php echo $value ?>
                </td>
              <?php endif; ?>
              <?php endforeach; ?>
              <td>--</td>
              <td>
                  --
              </td>
              <td>--</td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      <?php endif; ?>
    </div>
  </div>
</div>


