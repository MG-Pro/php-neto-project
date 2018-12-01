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
              <select class="form-control" id="category" name="categoryId">
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
              <textarea class="form-control" id="textarea" rows="3" name="content"><?php echo
                  $question['answer'] === null ? '' : $question['answer']?></textarea>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col text-right">
            <button type="submit" class="btn btn-success">Показать</button>
            <button type="submit" class="btn btn-danger">Удалить</button>
            <button type="submit" class="btn btn-primary">Сохранить</button>
          </div>
        </div>
        <input type="hidden" name="admin-question" value="update">
        <input type="hidden" name="answerId" value="<?php echo $question['answer_id']?>">
      </form>
    </div>
  </div>
</div>
