<?php

include_once 'models/QuestionModel.php';
include_once 'models/CategoriesModel.php';
include_once 'models/AuthorsModel.php';

class AdminQuestionController {
  private $msg = null;
  private $questionModel;
  private $categoriesModel;
  private $authorsModel;

  public function __construct($pdo) {
    $this->questionModel = new QuestionModel($pdo);
    $this->categoriesModel = new CategoriesModel($pdo);
    $this->authorsModel = new AuthorsModel($pdo);
  }

  private function toQuestionList($login, $catList, $qList, $activeCat, $msgClass = null) {
    render('admin/admin-header.php', ['adminName' => $login]);
    render('message.php', ['msg' => $this->msg, 'msgClass' => $msgClass]);
    render('admin/admin-panel.php');
    render('admin/admin-content.php', ['catList' => $catList, 'questionList' => $qList, 'activeCat' =>$activeCat]);
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
}

