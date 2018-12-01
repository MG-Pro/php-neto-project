<?php

include_once 'models/QuestionModel.php';
include_once 'models/CategoriesModel.php';
include_once 'models/AuthorsModel.php';
include_once 'models/AnswerModel.php';

class AdminQuestionController {
  private $msg = null;
  private $questionModel;
  private $categoriesModel;
  private $authorsModel;
  private $answerModel;

  public function __construct($pdo) {
    $this->questionModel = new QuestionModel($pdo);
    $this->categoriesModel = new CategoriesModel($pdo);
    $this->authorsModel = new AuthorsModel($pdo);
    $this->answerModel = new AnswerModel($pdo);
  }

  private function toQuestionList($login, $catList, $qList, $activeCat, $msgClass = null) {
    render('admin/admin-header.php', ['adminName' => $login]);
    render('message.php', ['msg' => $this->msg, 'msgClass' => $msgClass]);
    render('admin/admin-panel.php');
    render('admin/admin-content.php', ['catList' => $catList, 'questionList' => $qList, 'activeCat' =>$activeCat]);
  }

  private function toEditQuestion($login, $question, $catList, $msgClass = null) {
    render('admin/admin-header.php', ['adminName' => $login]);
    render('message.php', ['msg' => $this->msg, 'msgClass' => $msgClass]);
    render('admin/admin-panel.php');
    render('admin/edit-question.php', ['question' => $question, 'catList' => $catList]);
  }

  public function questionList($login, $categoryId) {
    $catList = $this->categoriesModel->categoriesList('title', 'asc', '%');
    if($categoryId !== null) {
      foreach ($catList as $i => $cat) {
        if ($cat['id'] === $categoryId) {
          $catIndex = $i;
          break;
        }
      }
    } else {
      $catIndex = 0;
    }
    $qList = $this->questionModel->questionList($catList[$catIndex]['id'], '%');
    $this->toQuestionList($login, $catList, $qList, $catList[ $catIndex ]['id']);
  }

  public function editQuestion($login, $id) {
    $catList = $this->categoriesModel->categoriesList('title', 'asc');
    $question = $this->questionModel->question($id);
    $this->toEditQuestion($login, $question[0], $catList);
  }

  public function update($admin, $qData) {
    $catList = $this->categoriesModel->categoriesList('title', 'asc');
    $login = $admin['login'];
    if (strlen($qData['email']) < 7) {
      $this->msg = 'Email должен быть не короче 7 символов';
      $this->toEditQuestion($login, $qData, $catList, 'alert-danger');
    } elseif (strlen($qData['author']) < 3) {
      $this->msg = 'Имя должно быть не короче 3 символов';
      $this->toEditQuestion($login, $qData, $catList, 'alert-danger');
    } elseif (strlen($qData['title']) < 5) {
      $this->msg = 'Заголовок должен быть не короче 5 символов';
      $this->toEditQuestion($login, $qData, $catList, 'alert-danger');
    } elseif (strlen($qData['content']) < 10) {
      $this->msg = 'Заголовок должен быть не короче 10 символов';
      $this->toEditQuestion($login, $qData, $catList, 'alert-danger');
    } elseif (strlen($qData['answer']) < 10) {
      $this->msg = 'Ответ должен быть не короче 10 символов';
      $this->toEditQuestion($login, $qData, $catList, 'alert-danger');
    } else {
      $qData['adminId'] = $admin['id'];
      if($qData['answer_id'] === null) {
        $qData['answer_id'] = $this->answerModel->add($qData['answer'], $admin['id']);
      }
      $this->questionModel->update($qData);
    }
  }

  public function deleteQuestion($login, $id) {

  }

  public function showToggleQuestion($login, $id) {

  }
}

