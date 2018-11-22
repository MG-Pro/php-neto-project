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
        <button type="submit" class="btn btn-primary">Отправить</button>
      </form>
      <?php if (count($categoriesList) > 0): ?>
        <table class="table table-striped table-hover text-center">
          <thead class="thead-light">
          <tr>
            <th scope="col">
              <a href="index.php?admin=admin-categories&sortBy=num">#</a>
            </th>
            <th scope="col">
              <a href="index.php?admin=admin-categories&sortBy=title">Имя</a>
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
                <td>
                  <?php echo $value ?>
                </td>
              <?php endforeach; ?>
              <td>--</td>
              <td>
                <form action="index.php" method="post" class="d-inline-block">
                  <input type="hidden" name="admin" value="status-toggle">
                  <input type="hidden" name="login" value="<?php echo $item['login'] ?>">
                  <?php $class = $value === '1' ? 'btn-danger' : 'btn-success'; ?>
                  <?php $value = $value === '1' ? 'Off' : 'On'; ?>
                  <button class="btn btn-sm <?php echo $class ?>"><?php echo $value ?></button>
                </form>
                <form action="index.php" method="post" class="d-inline-block">
                  <input type="hidden" name="admin" value="delete">
                  <input type="hidden" name="login" value="<?php echo $item['login'] ?>">
                  <button class="btn btn-sm btn-danger">
                    <span aria-hidden="true">&times;</span>
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


