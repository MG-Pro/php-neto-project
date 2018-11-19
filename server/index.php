<?php
include_once 'config.php';
session_start();
$pdo = new PDO(
  "mysql:host=localhost;dbname=faq;charset=UTF8",
  DB_LOGIN,
  DB_PASS);


function render($template, $params = []) {
  $fileTemplate = 'views/templates/' . $template;
  if(!isset($params['msgClass'])) {
    $params['msgClass'] = false;
  }
  if (is_file($fileTemplate)) {
    ob_start();
    if (count($params) > 0) {
      extract($params);
    }
    include $fileTemplate;
    echo ob_get_clean();
  }
}

render('head.php');
include_once 'routers/userRouter.php';
render('footer.php');
