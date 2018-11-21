<?php
class AdminModel {
  private $pdo;
  public function __construct($pdo) {
    $this->pdo = $pdo;
  }
  private function request($sql) {
    return $this->pdo->query($sql);
  }
  public function signIn($login, $pas) {
    $sqlSignIn = "SELECT id, login, status FROM admins WHERE login='$login' AND pass='$pas' LIMIT 1";
    return $this->request($sqlSignIn)->fetchAll(PDO::FETCH_ASSOC);
  }
  public function signUp($login, $pas) {
    $sqlSignUp = "INSERT INTO admins SET login='$login', pass='$pas'";
    $sqlLastUserId = "SELECT @@IDENTITY";
    $this->request($sqlSignUp)->fetchAll(PDO::FETCH_ASSOC);
    return $this->request($sqlLastUserId)->fetchAll(PDO::FETCH_ASSOC);
  }
  public function adminList() {
    $sqlAdminList = "SELECT id, login, date_reg, status FROM admins";
    return $this->request($sqlAdminList)->fetchAll(PDO::FETCH_ASSOC);
  }
}
