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
              <a href="index.php?admin=admin-categories&sortBy=title&dir=<?php echo $dir ?>">Имя</a>
            </th>
            <th scope="col">
              <a href="index.php?admin=admin-categories&sortBy=count_q">Вопросы</a>
            </th>
            <th scope="col">
              <a href="index.php?admin=admin-categories&sortBy=public_q">Опубликовано</a>
            </th>
            <th scope="col">
              <a href="index.php?admin=admin-categories&sortBy=waiting_q">Без ответа</a>
            </th>
            <th scope="col">Действия</th>
          </tr>
          </thead>
          <tbody>
          <?php foreach ($categoriesList as $item): ?>
            <tr>
              <?php foreach ($item as $key => $value): ?>
                <?php if ($key === 'title'): ?>
                  <td>
                    <a href="index.php?admin=admin-questions&id=<?php echo $item['id'] ?>"><?php echo $value ?></a>
                  </td>
                <?php elseif ($key === 'id') : ?>
                  <?php continue; ?>
                <?php else: ?>
                  <td>
                    <?php echo $value ?>
                  </td>
                <?php endif; ?>
              <?php endforeach; ?>
              <td>
                <form action="index.php" method="post" class="d-inline-block">
                  <input type="hidden" name="category" value="delete">
                  <input type="hidden" name="id" value="<?php echo $item['id'] ?>">
                  <input type="hidden" name="title" value="<?php echo $item['title'] ?>">
                  <button class="btn btn-sm btn-danger">
                    <span aria-hidden="true">X</span>
                  </button>
                </form>
                <form action="index.php" method="get" class="d-inline-block">
                  <input type="hidden" name="admin" value="category-rename">
                  <input type="hidden" name="id" value="<?php echo $item['id'] ?>">
                  <input type="hidden" name="title" value="<?php echo $item['title'] ?>">
                  <button class="btn btn-sm btn-success">
                    <span aria-hidden="true">Rename</span>
                  </button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      <?php endif; ?>
    </div>
  </div>
</div>


