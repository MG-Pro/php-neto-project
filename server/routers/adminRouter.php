<?php
include_once 'controllers/adminController.php';
$adminController = new AdminController($pdo);

if (isset($_GET['admin'])) {
  if ($_GET['admin'] === 'signin') {
    if (isset($_SESSION['admin']['login'])) {
      $adminController->toAdmin($_SESSION['admin']['login']);
    } else {
      $adminController->signIn();
    }
  } elseif ($_GET['admin'] === 'signup') {
    $adminController->signUp();
  } elseif ($_GET['admin'] === 'signout') {
    $adminController->signOut();
  } elseif ($_GET['admin'] === 'admin-list') {
    if (isset($_SESSION['admin']['login'])) {
      $adminController->adminList($_SESSION['admin']['login']);
    } else {
      $adminController->signIn();
    }

  }
} elseif (isset($_POST['admin'])) {
  if ($_POST['admin'] === 'signin') {
    $login = $_POST['login'];
    $pas = $_POST['pas'];
    $admin = $adminController->signIn($login, $pas);
  } elseif ($_POST['admin'] === 'signup') {
    $login = $_POST['login'];
    $pas = $_POST['pas'];
    $pas2 = $_POST['pas2'];
    $admin = $adminController->signUp($login, $pas, $pas2);
  }

}




