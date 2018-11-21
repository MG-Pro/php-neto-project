<div class="container">
  <div class="row">
    <div class="col">
      <h4 class="mb-3 mt-2">Администраторы</h4>
      <table class="table table-striped table-hover text-center">
        <thead class="thead-light">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Имя</th>
          <th scope="col">Дата регистрации</th>
          <th scope="col">Статус</th>
          <th scope="col">Ответы</th>
          <th scope="col">Действия</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($adminList as $item): ?>
          <tr>
            <?php foreach ($item as $key => $value): ?>
              <td>
                <?php if ($key === 'status'): ?>
                  <?php $status = $value === '1' ? 'Активирован' : 'Отключен'; ?>
                  <?php echo $status ?>
                <?php else: ?>
                  <?php echo $value ?>
                <?php endif; ?>
              </td>
            <?php endforeach; ?>
            <td>--</td>
            <td>
              <form action="index.php" method="post" class="d-inline-block">
                <input type="hidden" name="admin" value="status-toggle">
                <input type="hidden" name="id" value="<?php echo $item['id'] ?>">
                <?php $class = $value === '1' ? 'btn-danger' : 'btn-success'; ?>
                <?php $value = $value === '1' ? 'Off' : 'On'; ?>
                <button class="btn btn-sm <?php echo $class?>"><?php echo $value ?></button>
              </form>
              <form action="index.php" method="post" class="d-inline-block">
                <input type="hidden" name="admin" value="delete">
                <input type="hidden" name="id" value="<?php echo $item['id'] ?>">
                <button  class="btn btn-sm btn-danger">
                  <span aria-hidden="true">&times;</span>
                </button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
