<div class="container">
  <div class="row">
    <div class="col">
      <h4 class="mb-3 mt-2">Категории</h4>
      <hr>
    </div>
  </div>
  <div class="row">
    <div class="col-3 admin-sidebar border-right">
      <div class="list-group">
        <?php foreach ($catList as $cat): ?>
          <?php
          $activeAll = $activeCat === 'all' ? 'active' : '';
          $active = $activeCat === $cat['id'] ? 'active' : '';
          ?>
          <a
            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center <?php echo $active ?>"
            href="index.php?admin=admin-questions&id=<?php echo $cat['id'] ?>"
          >
            <?php echo $cat['title'] ?>
            <span class="badge badge-primary badge-danger">
        <?php echo $cat['count_q'] ?>
      </span>
          </a>
        <?php endforeach; ?>
        <a
          class="list-group-item list-group-item-action d-flex justify-content-between align-items-center <?php echo
          $activeAll ?>"
          href="index.php?admin=admin-questions&id=all"
        >Все вопросы
          <span class="badge badge-primary badge-danger">
        <?php echo $count ?>
      </span></a>
      </div>
    </div>
    <div class="col-9 admin-content">
      <div class="row  mr-2">
        <div class="col">
          <form action="index.php" method="get">
            <input type="hidden" name="admin" value="admin-questions">
            <input type="hidden" name="id" value="<?php echo $activeCat ?>">
            <div class="form-group row text-right">
              <div class="col-4"></div>
              <label class="col-2 col-form-label text-right">Фильтр:</label>
              <div class="col-4">
                <select class="form-control" name="filter">
                  <option value="all">Все</option>
                  <option value="answered">С ответом</option>
                  <option value="unanswered">Без ответа</option>
                </select>
              </div>
              <div class="col-2">
                <button class="btn badge-dark">Применить</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div id="questionList">
        <?php if (count($questionList) === 0): ?>
          <h5><?php echo "В категории пока нет вопросов" ?></h5>
        <?php endif; ?>
        <?php foreach ($questionList as $question): ?>
          <div class="card mb-3">
            <div class="card-header">
              <div class="row">
                <div class="col-6">
                  <h5 class="card-title">
                    <?php echo strtoupper($question['title']) ?>
                  </h5>
                  <p class="card-subtitle text-muted">
                    <span class="text-dark font-weight-bold">Автор: </span>
                    <?php echo $question['author'] ?>
                  </p>
                </div>
                <div class="col-2">
                  <p class="card-subtitle text-muted">
                    <span class="text-dark font-weight-bold">Статус: </span>
                    <?php
                    if ($question['is_show']) {
                      $isShow = 'Показан';
                      $isShowClass = 'success';
                    } else {
                      $isShow = 'Скрыт';
                      $isShowClass = 'warning';
                    }
                    ?>
                    <span class="badge badge-<?php echo $isShowClass ?> p-1"><?php echo $isShow ?></span>
                  </p>
                </div>
                <div class="col-4 text-right">
                  <p class="card-subtitle text-muted">
                    <span class="text-dark font-weight-bold">Добавлен: </span><br>
                    <?php echo date('d.m.Y H:i', strtotime($question['date_added'])) ?>
                  </p>
                </div>
              </div>
            </div>
            <div class="card-body">
              <p class="card-text font-italic mb-0">
                <?php echo $question['content'] ?>
              </p>
              <?php if ($question['answer'] !== null): ?>
                <div class="answer d-none">
                  <hr>
                  <p class="card-subtitle text-muted text-right">
                    <span class="text-dark font-weight-bold">Добавлен: </span>
                    <?php echo date('d.m.Y H:i', strtotime($question['answer_date'])) ?>
                  </p>
                  <p class="card-text">
                    <?php echo $question['answer'] ?>
                  </p>
                </div>
              <?php endif; ?>
            </div>
            <div class="card-footer text-right">
              <?php if ($question['answer'] !== null): ?>
                <a href="#" class="btn btn-secondary show-answer">Посмотреть ответ</a>
                <a href="index.php?admin=edit-question&id=<?php echo $question['id'] ?>"
                  class="btn btn-primary">Редактировать вопрос</a>
              <?php else: ?>
                <a href="index.php?admin=edit-question&id=<?php echo $question['id'] ?>" class="btn btn-primary">Добавить
                  ответ</a>
              <?php endif; ?>
              <a href="index.php?admin=delete-question&id=<?php echo $question['id'] ?>"
                class="btn btn-danger">Удалить</a>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>


