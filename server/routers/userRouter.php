<?php

$questionController = new QuestionController($pdo);

if(isset($_GET['question'])) {
  if ($_GET['question'] === 'add') {
    $questionController->addForm();
  } elseif ($_GET['question'] === 'category') {
    $questionController->questionList($_REQUEST['id']);
  }

} elseif (isset($_POST['question'])) {
  if ($_POST['question'] === 'add') {
    $questionController->add($_POST);
  }

} elseif (
  isset($_GET['admin']) ||
  isset($_POST['admin']) ||
  isset($_POST['category']) ||
  isset($_POST['admin-question']) ||
  isset($_GET['category'])) {
  include_once 'routers/adminRouter.php';
} else {
  $questionController->questionList(null);
}







