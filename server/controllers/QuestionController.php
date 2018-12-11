<?php

class QuestionController {
  private $msg = null;
  private $questionModel;
  private $categoriesModel;
  private $authorsModel;

  public function __construct($pdo) {
    $this->questionModel = new QuestionModel($pdo);
    $this->categoriesModel = new CategoriesModel($pdo);
    $this->authorsModel = new AuthorsModel($pdo);
  }

  private function toQuestionList($catList, $questionList, $activeCat, $msgClass) {
    render('front/header.php');
    render('front/main.php', ['catList' => $catList, 'questionList' => $questionList, 'activeCat' => $activeCat, 'msg' => $this->msg, 'msgClass' => $msgClass]);
  }

  private function toAddForm($catList, $msgClass = null) {
    render('front/header.php');
    render('message.php', ['msg' => $this->msg, 'msgClass' => $msgClass]);
    render('front/add-question.php', ['catList' => $catList]);
  }

  public function questionList($categoryId, $msgClass = null) {
    $catList = $this->categoriesModel->categoriesList('title', 'asc');
    if($categoryId !== null && is_numeric($categoryId)) {
      foreach ($catList as $i => $cat) {
        if ($cat['id'] === $categoryId) {
          $catIndex = $i;
          break;
        }
      }
    } else {
      $catIndex = 0;
    }
    $questionList = $this->questionModel->questionList($catList[$catIndex]['id']);
    $this->toQuestionList($catList, $questionList, $catList[ $catIndex ]['id'], $msgClass);
  }

  public function addForm() {
    $catList = $this->categoriesModel->categoriesList('title', 'asc');
    $this->toAddForm($catList);
  }

  public function add($qData) {
    $catList = $this->categoriesModel->categoriesList('title', 'asc');
    if (strlen($qData['email']) < 7) {
      $this->msg = 'Email должен быть не короче 7 символов';
      $this->toAddForm($catList, 'alert-danger');
    } elseif (strlen($qData['author']) < 3) {
      $this->msg = 'Имя должно быть не короче 3 символов';
      $this->toAddForm($catList, 'alert-danger');
    } elseif (strlen($qData['title']) < 3) {
      $this->msg = 'Заголовок должен быть не короче 3 символов';
      $this->toAddForm($catList, 'alert-danger');
    } elseif (strlen($qData['content']) < 10) {
      $this->msg = 'Заголовок должен быть не короче 10 символов';
      $this->toAddForm($catList, 'alert-danger');
    } else {
      $author = $this->authorsModel->isExist($qData['email']);
      if (count($author) === 0) {
        $qData['author_id'] = $this->authorsModel->add($qData['author'], $qData['email']);
      } else {
        $qData['author_id'] = $author[0]['id'];
      }
      $this->questionModel->add($qData);
      $this->msg = 'Вопрос добавлен';
      $this->questionList(null, 'alert-success');
    }
  }
}
