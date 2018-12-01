<?php
include_once 'controllers/AdminController.php';
include_once 'controllers/AdminCategoriesController.php';
include_once 'controllers/AdminQuestionController.php';

$adminController = new AdminController($pdo);
$adminCategoriesController = new AdminCategoriesController($pdo);
$adminQuestionController = new AdminQuestionController($pdo);

if (isset($_GET['admin'])) {
  if ($_GET['admin'] === 'signin') {
    if (isset($_SESSION['admin']['login'])) {
      $adminQuestionController->questionList($_SESSION['admin']['login'], null);
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
        $adminCategoriesController->categoriesList($_SESSION['admin']['login'], null, $_REQUEST['sortBy'], $_REQUEST['dir']);
      } else {
        $adminCategoriesController->categoriesList($_SESSION['admin']['login']);
      }
    } else {
      $adminController->signIn();
    }
  } elseif ($_GET['admin'] === 'admin-questions') {
    if (isset($_SESSION['admin']['login'])) {
      $catId = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;
      $adminQuestionController->questionList($_SESSION['admin']['login'], $catId);
    } else {
      $adminController->signIn();
    }
  } elseif ($_GET['admin'] === 'edit-question') {
    if (isset($_SESSION['admin']['login'])) {

      $adminQuestionController->editQuestion($_SESSION['admin']['login'], $_REQUEST['id']);
    } else {
      $adminController->signIn();
    }
  } elseif ($_GET['admin'] === 'delete-question') {
    if (isset($_SESSION['admin']['login'])) {
      // todo delete
    } else {
      $adminController->signIn();
    }
  } else {
    $adminController->signIn();
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
      $adminCategoriesController->toRenameForm($_SESSION['admin']['login'], $_GET['id'], $_GET['title']);
    } else {
      $adminController->signIn();
    }
  }

} elseif (isset($_POST['category'])) {
  if($_POST['category'] === 'add') {
    $adminCategoriesController->add($_SESSION['admin']['login'], $_POST['title']);
  } elseif ($_POST['category'] === 'rename') {
      $adminCategoriesController->rename($_SESSION['admin']['login'], $_POST['id'], $_POST['title']);
  } elseif ($_POST['category'] === 'delete') {
    $adminCategoriesController->delete($_SESSION['admin']['login'], $_POST['id'], $_POST['title']);
  }
} elseif (isset($_POST['admin-question'])) {
  if($_POST['admin-question'] === 'update') {
    $adminQuestionController->update($_SESSION['admin'], $_POST);
  }
}




