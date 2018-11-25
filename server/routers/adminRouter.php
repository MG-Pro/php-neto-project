<?php
include_once 'controllers/AdminController.php';
include_once 'controllers/CategoriesController.php';

$adminController = new AdminController($pdo);
$categoriesController = new CategoriesController($pdo);

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
  } elseif ($_GET['admin'] === 'admin-categories') {
    if (isset($_SESSION['admin']['login'])) {
      if(isset($_REQUEST['sortBy'])) {
        $categoriesController->categoriesList($_SESSION['admin']['login'], $_REQUEST['sortBy'], $_REQUEST['dir']);
      } else {
        $categoriesController->categoriesList($_SESSION['admin']['login']);
      }
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
  } elseif ($_POST['admin'] === 'status-toggle') {
    $adminController->statusToggle($_POST['login']);
  } elseif ($_POST['admin'] === 'delete') {
    $adminController->delete($_POST['login']);
  }

} elseif (isset($_GET['category'])) {
  if($_GET['category'] === 'rename') {
    if (isset($_SESSION['admin']['login'])) {
      $categoriesController->toRenameForm($_SESSION['admin']['login'], $_GET['id'], $_GET['title']);
    } else {
      $adminController->signIn();
    }
  }

} elseif (isset($_POST['category'])) {
  if($_POST['category'] === 'add') {
    $categoriesController->add($_SESSION['admin']['login'], $_POST['title']);
  } elseif ($_POST['category'] === 'rename') {
      $categoriesController->rename($_SESSION['admin']['login'], $_POST['id'], $_POST['title']);
  }
}




