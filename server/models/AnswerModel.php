<?php

class AnswerModel {
  private $pdo;
  public function __construct($pdo) {
    $this->pdo = $pdo;
  }
  private function request($sql) {
    return $this->pdo->query($sql);
  }
  public function add($content, $adminId) {
    $sqlAdd = "
    INSERT INTO answers 
    SET 
      content='$content',
      admin_id='$adminId'
    ";
    $sqlLastId = "SELECT @@IDENTITY";
    $this->request($sqlAdd)->fetchAll(PDO::FETCH_ASSOC);
    return $this->request($sqlLastId)->fetchAll(PDO::FETCH_ASSOC)[0]['@@IDENTITY'];
  }
}
