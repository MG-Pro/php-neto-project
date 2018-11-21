<?php
include_once 'models/adminModel.php';

class AdminController {
  private $msg = null;
  private $adminModel;

  public function __construct($pdo) {
    $this->adminModel = new AdminModel($pdo);
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
  public function signIn($login = null, $pas = null) {
    if ($login !== null && $pas !== null) {
      if (strlen($login) < 3) {
        $this->msg = 'Логин должен содержать не менее 3 символов';
        $this->toSignInForm('alert-danger');
      } elseif (strlen($pas) < 3) {
        $this->msg = 'Пароль должен содержать не менее 3 символов';
        $this->toSignInForm( 'alert-danger');
      } else {
        $admin = $this->adminModel->signIn($login, $pas);
        if (count($admin) !== '0') {
          if($admin[0]['status'] === '1') {
            $_SESSION['admin'] = $admin[0];
            $this->toAdmin($login);
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


  public function toAdmin($login, $msgClass = null) {
    render('admin/admin-header.php', ['adminName' => $login]);
    render('message.php', ['msg' => $this->msg, 'msgClass' => $msgClass]);
    render('admin/admin-content.php');
  }

}
