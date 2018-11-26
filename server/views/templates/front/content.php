
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
  <ul></ul>
</div>

