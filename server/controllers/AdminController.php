<?php

class AdminController {
  private $msg = null;
  private $adminModel;

  public function __construct($pdo) {
    $this->adminModel = new AdminModel($pdo);
  }

  public function toQuestionList($login, $catList, $qList, $msgClass = null) {
    render('admin/admin-header.php', ['adminName' => $login]);
    render('message.php', ['msg' => $this->msg, 'msgClass' => $msgClass]);
    render('admin/admin-panel.php');
    render('admin/admin-content.php', []);
  }

  private function toSignInForm($msgClass = null) {
    render('admin/admin-header.php', ['adminName' => null]);
    render('message.php', ['msg' => $this->msg, 'msgClass' => $msgClass]);
    render('admin/admin-signin.php');
  }

  private function toSignUpForm($msgClass = null) {
    render('admin/admin-header.php', ['adminName' => null]);
    render('message.php', ['msg' => $this->msg, 'msgClass' => $msgClass]);
    render('admin/admin-signup.php');
  }

  private function toAdminList($login, $list, $msgClass = null) {
    render('admin/admin-header.php', ['adminName' => $login]);
    render('admin/admin-panel.php');
    render('message.php', ['msg' => $this->msg, 'msgClass' => $msgClass]);
    render('admin/admin-list.php', ['adminList' => $list]);
  }

  public function toEditForm($login, $msgClass = null) {
    render('admin/admin-header.php', ['adminName' => $login]);
    render('admin/admin-panel.php');
    render('message.php', ['msg' => $this->msg, 'msgClass' => $msgClass]);
    render('admin/admin-admin-edit.php', ['login' => $login]);
  }

  public function signIn($login = null, $pas = null) {
    if ($login !== null && $pas !== null) {
      if (strlen($login) < 3) {
        $this->msg = 'Логин должен содержать не менее 3 символов';
        $this->toSignInForm('alert-danger');
      } elseif (strlen($pas) < 3) {
        $this->msg = 'Пароль должен содержать не менее 3 символов';
        $this->toSignInForm('alert-danger');
      } else {
        $admin = $this->adminModel->signIn($login, $pas);
        if (count($admin) !== '0') {
          if ($admin[0]['status'] === '1') {
            $_SESSION['admin'] = $admin[0];
            header('Location: index.php?admin=admin-questions');
            return $admin;
          } else {
            $this->msg = "Пользователь $login не имеет статус администратора";
            $this->toSignInForm('alert-warning');
          }
        } else {
          $this->msg = "Пользователь $login не зарегистрирован";
          $this->toSignInForm('alert-danger');
        }
      }
    } else {
      $this->toSignInForm();
    }
    return false;
  }

  public function signUp($login = null, $pas = null, $pas2 = null) {
    if ($login !== null && $pas !== null) {
      if (strlen($login) < 3) {
        $this->msg = 'Логин должен содержать не менее 3 символов';
        $this->toSignUpForm('alert-danger');
      } elseif (strlen($pas) < 3) {
        $this->msg = 'Пароль должен содержать не менее 3 символов';
        $this->toSignUpForm('alert-danger');
      } elseif (strlen($pas) !== strlen($pas2)) {
        $this->msg = 'Пароли не совпадают';
        $this->toSignUpForm('alert-danger');
      } else {
        $this->adminModel->signUp($login, $pas);
        $this->msg = "$login успешно зарегестрирован, ожидайте подтверждения";
        $this->toSignInForm('alert-success');
      }
    } else {
      $this->toSignUpForm();
    }
    return false;
  }

  public function signOut() {
    unset($_SESSION['admin']);
    $this->signIn();
  }

  public function adminList($login) {
    $adminList = $this->adminModel->adminList();
    $this->toAdminList($login, $adminList);
  }

  public function statusToggle($login) {
    $isSuper = $this->adminModel->isSuper($login);
    if ($isSuper) {
      $adminList = $this->adminModel->adminList();
      $this->msg = "Администатор '$login' не может быть отключен!";
      $this->toAdminList($login, $adminList, 'alert-danger');
    } else {
      $this->adminModel->statusToggle($login);
      $this->adminList($login);
    }
  }

  public function delete($login) {
    $isSuper = $this->adminModel->isSuper($login);
    if ($isSuper) {
      $adminList = $this->adminModel->adminList();
      $this->msg = "Администатор '$login' не может быть удален!";
      $this->toAdminList($login, $adminList, 'alert-danger');
    } else {
      $this->adminModel->delete($login);
      $this->adminList($login);
    }
  }

  public function edit($login, $oldPass, $newPass, $newPass2) {
    $admin = $this->adminModel->signIn($login, $oldPass);
    if (count($admin) === 0) {
      $this->msg = 'Старый пароль указан не верно';
      $this->toEditForm($login, 'alert-danger');
    } else {
      if (strlen($newPass) < 3) {
        $this->msg = 'Пароль должен содержать не менее 3 символов';
        $this->toEditForm($login, 'alert-danger');
      } elseif (strlen($newPass) !== strlen($newPass2)) {
        $this->msg = 'Пароли не совпадают';
        $this->toEditForm($login, 'alert-danger');
      } else {
        $this->adminModel->editPass($admin[0]['id'], $newPass);
        $this->msg = "Пароль изменен";
        $this->toEditForm($login, 'alert-success');
      }
    }


  }
}
