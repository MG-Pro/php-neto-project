<?php
if(isset($_GET['question'])) {
  if ($_GET['question'] === 'add') {
    render('add-question.php');
  }


} else {
  render('main.php');
}




?>


