<?php
include_once 'controllers/QuestionController.php';

$questionController = new QuestionController($pdo);

if(isset($_GET['question'])) {
  if ($_GET['question'] === 'add') {
    render('front/header.php');
    render('front/add-question.php');
  }


} elseif (
  isset($_GET['admin']) ||
  isset($_POST['admin']) ||
  isset($_POST['category']) ||
  isset($_GET['category'])) {
  include_once 'routers/adminRouter.php';
} else {
  $questionController->questionList();
}







