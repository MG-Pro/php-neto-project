<?php
include_once 'config.php';
session_start();
$pdo = new PDO(
  "mysql:host=localhost;dbname=faq;charset=UTF8",
  DB_LOGIN,
  DB_PASS);


function render($template, $params = []) {
  $fileTemplate = 'views/templates/' . $template;
  if (is_file($fileTemplate)) {
    ob_start();
    if (count($params) > 0) {
      extract($params);
    }
    include $fileTemplate;
    echo ob_get_clean();
  }
}

render('header.php');
include_once 'routers/router.php';
render('footer.php');
