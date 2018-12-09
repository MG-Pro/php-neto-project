<?php

class AnswerModel {
  private $pdo;
  public function __construct($pdo) {
    $this->pdo = $pdo;
  }

  public function add($content, $adminId) {
    $sqlAdd = "
    INSERT INTO answers 
    SET 
      content=':content',
      admin_id=':adminId'
    ";
    $sqlLastId = "SELECT @@IDENTITY";
    $stmt = $this->pdo->prepare($sqlAdd);
    $stmt->execute(["content" => $content, "adminId" => $adminId]);
    $stmt->fetchAll();

    $stmt = $this->pdo->prepare($sqlLastId);
    $stmt->execute();
    return $stmt->fetchAll()[0]['@@IDENTITY'];
  }

  public function delete($id) {
    $sqlDel = "
    DELETE FROM answers
    WHERE id=':id' 
    LIMIT 1";
    $stmt = $this->pdo->prepare($sqlDel);
    $stmt->execute(["id" => $id]);
    return $stmt->fetchAll();
  }
}
