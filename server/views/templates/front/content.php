
<div class="content col-9 ">
  <?php
  render('message.php', ['msg' => $msg, 'msgClass' => $msgClass]);
  ?>
  <div class="row">
    <div class="col mt-2 text-right ">
      <a class="btn btn-success btn-lg " href="index.php?question=add">Задать вопрос</a>
      <hr>
    </div>
  </div>
  <div id="questionList">
    <?php if(count($questionList) === 0): ?>
      <h5><?php echo "В категории пока нет вопросов"?></h5>
    <?php endif; ?>
    <?php foreach ($questionList as $question): ?>
    <div class="card mb-3">
      <div class="card-header">
        <div class="row">
          <div class="col-8">
            <h5 class="card-title">
              <?php echo strtoupper($question['title'])?>
            </h5>
            <p class="card-subtitle text-muted">
              <span class="text-dark font-weight-bold">Автор: </span>
              <?php echo $question['author']?>
            </p>
          </div>
          <div class="col-4 text-right">
            <p class="card-subtitle text-muted">
              <span class="text-dark font-weight-bold">Добавлен: </span><br>
              <?php echo date('d.m.Y H:i', strtotime($question['date_added']))?>
            </p>
          </div>
        </div>
      </div>
      <div class="card-body">
        <p class="card-text font-italic mb-0">
          <?php echo $question['content']?>
        </p>
        <div class="answer d-none">
          <hr>
          <p class="card-subtitle text-muted text-right">
            <span class="text-dark font-weight-bold">Добавлен: </span>
            <?php echo date('d.m.Y H:i', strtotime($question['answer_date']))?>
          </p>
          <p class="card-text">
            <?php echo $question['answer'] ?>
          </p>
        </div>

      </div>
      <div class="card-footer text-right">
        <a href="#" class="card-link show-answer">Посмотреть ответ</a>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</div>

