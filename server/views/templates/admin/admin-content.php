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
          <?php $active = $activeCat === $cat['id'] ? 'active' : '' ?>
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
      </div>
    </div>
    <div class="col-9 admin-content">
      <div id="questionList">
        <?php if (count($questionList) === 0): ?>
          <h5><?php echo "В категории пока нет вопросов" ?></h5>
        <?php endif; ?>
        <?php foreach ($questionList as $question): ?>
          <div class="card mb-3">
            <div class="card-header">
              <div class="row">
                <div class="col-8">
                  <h5 class="card-title">
                    <?php echo strtoupper($question['title']) ?>
                  </h5>
                  <p class="card-subtitle text-muted">
                    <span class="text-dark font-weight-bold">Автор: </span>
                    <?php echo $question['author'] ?>
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
                <a href="#" class="card-link show-answer">Посмотреть ответ</a>
                <a href="index.php?admin=edit-question" class="card-link">Редактировать вопрос</a>
              <?php else: ?>
                <a href="index.php?admin=edit-question" class="card-link">Добавить ответ</a>
              <?php endif; ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>


