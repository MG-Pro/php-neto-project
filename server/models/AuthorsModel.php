<?php

class AuthorsModel {
  private $pdo;
  public function __construct($pdo) {
    $this->pdo = $pdo;
  }
  private function request($sql) {
    return $this->pdo->query($sql);
  }
  public function add($name, $email) {
    $sqlAdd = "INSERT INTO authors SET name='$name', email='$email'";
    $sqlLastId = "SELECT @@IDENTITY";
    $this->request($sqlAdd)->fetchAll(PDO::FETCH_ASSOC);
    return $this->request($sqlLastId)->fetchAll(PDO::FETCH_ASSOC)[0]['@@IDENTITY'];
  }
  public function isExist($email) {
    $sqlIsExists = "SELECT id FROM authors WHERE email='$email' LIMIT 1";
    return $this->request($sqlIsExists)->fetchAll(PDO::FETCH_ASSOC);
  }

}
