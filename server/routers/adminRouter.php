<?php
include_once 'controllers/adminController.php';
$adminController = new AdminController($pdo);

if (isset($_GET['admin'])) {
  if ($_GET['admin'] === 'entry') {
    if (isset($_SESSION['admin']['login'])) {
      $adminController->toAdmin($_SESSION['admin']['login']);
    } else {
      $adminController->signIn();
    }
  } elseif ($_GET['admin'] === 'exit') {
    $adminController->signOut();
  }
} elseif (isset($_POST['admin'])) {
  if($_POST['admin'] === 'signin') {
    $login = $_POST['login'];
    $pas = $_POST['pas'];
    $admin = $adminController->signIn($login, $pas);
  }


}



