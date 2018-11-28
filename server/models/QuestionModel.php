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
    SELECT 
     q.id as id, 
     q.title as title, 
     c.title as category, 
     q.content as content, 
     q.date_added as date_added,
     a.name as author,
     an.content as answer,
     an.date_added as answer_date
    FROM questions q
    JOIN categories c ON q.category_id=c.id
    JOIN authors a ON q.author_id=a.id
    JOIN answers an ON q.answer_id=an.id
    WHERE q.category_id='$categoryId' AND q.answer_id IS NOT NULL
    order by q.date_added";
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
