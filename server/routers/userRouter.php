<?php
if(isset($_GET['question'])) {
  if ($_GET['question'] === 'add') {
    render('front/header.php');
    render('front/add-question.php');
  }


} elseif (isset($_GET['admin']) || isset($_POST['admin'])) {
  include_once 'routers/adminRouter.php';
} else {
  render('front/header.php');
  render('front/main.php');
}




?>

