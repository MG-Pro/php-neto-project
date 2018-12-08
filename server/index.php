<?php
include_once 'config.php';
session_start();
$pdo = new PDO(
  "mysql:host=localhost;dbname=" . DB_NAME. ";charset=UTF8",
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

spl_autoload_register(function ($class_name) {
  $modelPath = 'models/' . $class_name . '.php';
  $controllersPath = 'controllers/' . $class_name . '.php';
  if (file_exists($modelPath)) {
    include_once $modelPath;
  } elseif (file_exists($controllersPath)) {
    include_once $controllersPath;
  }
});

render('head.php');
include_once 'routers/userRouter.php';
render('footer.php');
