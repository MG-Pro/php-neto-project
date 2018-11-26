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
  public function add($qData) {
    $title = $qData['title'];
    $authorId = $qData['authorId'];
    $categoryId = $qData['categoryId'];
    $content = $qData['content'];

    $sqlAdd = "
    INSERT INTO questions 
    SET 
      title='$title',
      author_id='$authorId',
      category_id='$categoryId',
      content='$content'
    ";
    $sqlLastId = "SELECT @@IDENTITY";
    $this->request($sqlAdd)->fetchAll(PDO::FETCH_ASSOC);
    return $this->request($sqlLastId)->fetchAll(PDO::FETCH_ASSOC)[0]['@@IDENTITY'];
  }
}
