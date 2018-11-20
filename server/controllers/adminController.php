<?php
include_once 'models/adminModel.php';

class AdminController {
  private $msg = null;
  private $adminModel;

  public function __construct($pdo) {
    $this->adminModel = new AdminModel($pdo);
  }
  private function toForm($login = null, $msgClass = null) {
    render('admin/admin-header.php', ['adminName' => $login]);
    render('message.php', ['msg' => $this->msg, 'msgClass' => $msgClass]);
    render('admin/admin-signin.php');
  }
  public function signIn($login = null, $pas = null) {
    if ($login !== null && $pas !== null) {
      if (strlen($login) < 3) {
        $this->msg = 'Логин должен содержать не менее 3 символов';
        $this->toForm(null, 'alert-danger');
      } elseif (strlen($pas) < 3) {
        $this->msg = 'Пароль должен содержать не менее 3 символов';
        $this->toForm(null, 'alert-danger');
      } else {
        $admin = $this->adminModel->signIn($login, $pas);
        if (count($admin) !== 0) {
          $_SESSION['admin'] = $admin[0];
          $this->toAdmin($login);
          return $admin;
        } else {
          $this->msg = "Пользователь $login не зарегистрирован";
          $this->toForm($login, 'alert-danger');
        }
      }
    } else {
      $this->toForm();
    }
    return false;
  }
  public function signUp($login, $pas) {

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
