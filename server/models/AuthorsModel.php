<?php

class AuthorsModel {
  private $pdo;
  public function __construct($pdo) {
    $this->pdo = $pdo;
  }
  public function add($name, $email) {
    $sqlAdd = "INSERT INTO authors SET name=':name', email=':email'";
    $sqlLastId = "SELECT @@IDENTITY";

    $stmt = $this->pdo->prepare($sqlAdd);
    $stmt->execute(["name" => $name, "email" => $email]);
    $stmt->fetchAll();

    $stmt = $this->pdo->prepare($sqlLastId);
    $stmt->execute();
    return $stmt->fetchAll()[0]['@@IDENTITY'];
  }
  public function isExist($email) {
    $sqlIsExists = "SELECT id FROM authors WHERE email='$email' LIMIT 1";
    $stmt = $this->pdo->prepare($sqlIsExists);
    $stmt->execute(["email" => $email]);
    $stmt->fetchAll();
  }

}
