<?php

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
      if (isset($_REQUEST['sortBy'])) {
        $adminCategoriesController->categoriesList($_SESSION['admin']['login'], null, $_REQUEST['sortBy'], $_REQUEST['dir']);
      } else {
        $adminCategoriesController->categoriesList($_SESSION['admin']['login']);
      }
    } else {
      $adminController->signIn();
    }
  } elseif ($_GET['admin'] === 'category-rename') {
    if (isset($_SESSION['admin']['login'])) {
      $adminCategoriesController->toRenameForm($_SESSION['admin']['login'], $_GET['id'], $_GET['title']);
    } else {
      $adminController->signIn();
    }
  } elseif ($_GET['admin'] === 'admin-questions') {
    if (isset($_SESSION['admin']['login'])) {
      $catId = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;
      if(isset($_REQUEST['filter'])) {
        $adminQuestionController->questionList($_SESSION['admin']['login'], $catId, $_REQUEST['filter']);
      } else {
        $adminQuestionController->questionList($_SESSION['admin']['login'], $catId);
      }
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
      $adminQuestionController->deleteQuestion($_SESSION['admin']['login'], $_REQUEST['id']);
    } else {
      $adminController->signIn();
    }
  } elseif ($_GET['admin'] === 'show-toggle-question') {
    if (isset($_SESSION['admin']['login'])) {
      $adminQuestionController->showToggleQuestion($_SESSION['admin']['login'], $_REQUEST['id']);
    } else {
      $adminController->signIn();
    }
  } elseif ($_GET['admin'] === 'admin-edit') {
    if (isset($_SESSION['admin']['login'])) {
      $adminController->toEditForm($_SESSION['admin']['login']);
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
  } elseif ($_POST['admin'] === 'edit-pass') {
    $adminController->edit($_POST['login'], $_POST['old-pas'], $_POST['new-pas'], $_POST['new-pas2']);
  }

} elseif (isset($_POST['category'])) {
  if ($_POST['category'] === 'add') {
    $adminCategoriesController->add($_SESSION['admin']['login'], $_POST['title']);
  } elseif ($_POST['category'] === 'rename') {
    $adminCategoriesController->rename($_SESSION['admin']['login'], $_POST['id'], $_POST['title']);
  } elseif ($_POST['category'] === 'delete') {
    if($_POST['need-confirm'] === '1') {
      $adminCategoriesController->delete(
        $_SESSION['admin']['login'],
        $_POST['id'],
        $_POST['question-count'],
        $_POST['title']);
    } else {
      $adminQuestionController->groupDeleteQuestions($_POST['id']);
      $adminCategoriesController->delete(
        $_SESSION['admin']['login'],
        $_POST['id'],
        $_POST['question-count'],
        $_POST['title'],
        false);
    }
  }
} elseif (isset($_POST['admin-question'])) {
  if ($_POST['admin-question'] === 'update') {
    $adminQuestionController->update($_SESSION['admin'], $_POST);
  }


}




