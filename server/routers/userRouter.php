<?php
if(isset($_GET['question'])) {
  if ($_GET['question'] === 'add') {
    render('add-question.php');
  }


} elseif (isset($_GET['admin']) || isset($_POST['login'])) {
  include_once 'routers/adminRouter.php';
} else {
  render('main.php');
}




?>


