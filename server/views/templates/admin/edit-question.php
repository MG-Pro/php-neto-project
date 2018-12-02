<div class="container">
  <div class="row">
    <div class="content col">
      <h4 class="mb-3 mt-2">Редактирование вопроса</h4>
      <hr>
      <form class="mb-5" action="index.php" method="post">
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label for="email">Email автора</label>
              <input type="email" class="form-control" id="email" name="email" disabled
                value="<?php echo $question['author_email'] ?>">
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="name">Имя автора</label>
              <input type="text" class="form-control" id="name" name="author" disabled
                value="<?php echo $question['author'] ?>">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label for="category">Категория</label>
              <select class="form-control" id="category" name="category_id">
                <?php foreach ($catList as $cat): ?>
                  <option
                    value="<?php echo $cat['id'] ?>"
                    <?php echo $cat['title'] === $question['category'] ? 'selected' : '' ?>
                  ><?php echo $cat['title'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="title">Заголовок вопроса</label>
              <input class="form-control" id="title" name="title" value="<?php echo $question['title'] ?>">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label for="textarea">Содержание вопроса</label>
              <textarea class="form-control" id="textarea" rows="3" name="content"><?php echo
                $question['content'] ?></textarea>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label for="textarea">Ответ</label>
              <textarea class="form-control" id="textarea" rows="3" name="answer"><?php echo
                  $question['answer'] === null ? '' : $question['answer']?></textarea>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col text-right">
            <?php if (!$question['is_show']): ?>
            <a href="index.php?admin=show-question&id=<?php echo $question['id']?>" class="btn btn-success">Показать</a>
            <?php else: ?>
              <a href="index.php?admin=hide-question&id=<?php echo $question['id']?>" class="btn btn-warning">Скрыть</a>
            <?php endif; ?>
            <a href="index.php?admin=delete-question&id=<?php echo $question['id']?>" class="btn btn-danger">Удалить</a>
            <button type="submit" class="btn btn-primary">Сохранить</button>
          </div>
        </div>
        <input type="hidden" name="admin-question" value="update">
        <input type="hidden" name="id" value="<?php echo $question['id']?>">
        <input type="hidden" name="answer_id" value="<?php echo $question['answer_id']?>">
      </form>
    </div>
  </div>
</div>
