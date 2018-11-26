<div class="container">
  <div class="row">
    <div class="content col">
      <h3>Задайте вопрос</h3>
      <hr>
      <form class="mb-5" action="index.php" method="post">
        <div class="col-6">
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email">
          </div>
          <div class="form-group">
            <label for="name">Ваше имя</label>
            <input type="text" class="form-control" id="name" name="author">
          </div>
          <div class="form-group">
            <label for="category">Категория</label>
            <select class="form-control" id="category" name="categoryId">
              <?php foreach ($catList as $cat): ?>
                <option value="<?php echo $cat['id']?>"><?php echo $cat['title']?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="title">Заголовок вопроса</label>
            <input class="form-control" id="title" name="title">
          </div>
        </div>
        <div class="col-12">
          <div class="form-group">
            <label for="textarea">Содержание вопроса</label>
            <textarea class="form-control" id="textarea" rows="3" name="content"></textarea>
          </div>
          <input type="hidden" name="question" value="add">
          <button type="submit" class="btn btn-primary">Отправить</button>
        </div>
      </form>
    </div>
  </div>
</div>

