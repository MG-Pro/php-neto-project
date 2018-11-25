<?php

class QuestionModel {
  private $pdo;
  public function __construct($pdo) {
    $this->pdo = $pdo;
  }
  private function request($sql) {
    return $this->pdo->query($sql);
  }
  public function questionList($categoryId = '%') {
    $sqlQuestionList = "
    SELECT id, title, category_id, content,  date_added 
    FROM questions 
    WHERE category_id='$categoryId' 
    order by date_added";
    return $this->request($sqlQuestionList)->fetchAll(PDO::FETCH_ASSOC);
  }

}
