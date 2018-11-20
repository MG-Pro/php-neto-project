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
    $sqlSignIn = "SELECT id, login FROM admins WHERE login='$login' AND pass='$pas' LIMIT 1";
    return $this->request($sqlSignIn)->fetchAll(PDO::FETCH_ASSOC);
  }
}
