<?php
include_once 'models/QuestionModel.php';
include_once 'models/CategoriesModel.php';

class QuestionController {
  private $msg = null;
  private $questionModel;
  private $categoriesModel;

  public function __construct($pdo) {
    $this->questionModel = new QuestionModel($pdo);
    $this->categoriesModel = new CategoriesModel($pdo);
  }
  private function toQuestionList($catList, $questionList) {
    render('front/header.php');
    render('front/main.php', ['catList' => $catList, 'questionList' => $questionList]);
  }
  public function questionList($categoryId = 0) {
    $catList = $this->categoriesModel->categoriesList('title', 'asc');
    $questionList = $this->questionModel->questionList($catList[$categoryId]['id']);
    $this->toQuestionList($catList, $questionList);
  }

}
