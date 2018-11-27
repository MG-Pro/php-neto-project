
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
  <div>
    <?php foreach ($questionList as $question): ?>
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-5">
            <?php echo $question['title']?>
          </div>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</div>

