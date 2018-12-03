<?php

class QuestionModel {
  private $pdo;
  public function __construct($pdo) {
    $this->pdo = $pdo;
  }
  private function request($sql) {
    return $this->pdo->query($sql);
  }
  public function questionList($categoryId = '%', $status = '1') {
    $status = $status === '1' ? $status : 'q.is_show';
    $sqlQuestionList = "
    SELECT 
     q.id as id, 
     q.title as title, 
     c.title as category, 
     q.content as content, 
     q.date_added as date_added,
     a.name as author,
     an.content as answer,
     an.date_added as answer_date,
     q.is_show as is_show
    FROM questions q
    LEFT JOIN categories c ON q.category_id=c.id
    LEFT JOIN authors a ON q.author_id=a.id
    LEFT JOIN answers an ON q.answer_id=an.id
    WHERE q.category_id='$categoryId' 
      AND q.is_show=$status
    order by q.date_added";
    return $this->request($sqlQuestionList)->fetchAll(PDO::FETCH_ASSOC);
  }
  public function question($id) {
    $sqlQuestion = "
    SELECT 
     q.id as id, 
     q.title as title, 
     c.title as category,
     c.id as category_id,
     q.content as content, 
     q.date_added as date_added,
     a.name as author,
     a.email as author_email,
     an.content as answer,
     an.id as answer_id,
     an.date_added as answer_date,
     q.is_show as is_show
    FROM questions q
    LEFT JOIN categories c ON q.category_id=c.id
    LEFT JOIN authors a ON q.author_id=a.id
    LEFT JOIN answers an ON q.answer_id=an.id
    WHERE q.id='$id' 
    LIMIT 1";
    return $this->request($sqlQuestion)->fetchAll(PDO::FETCH_ASSOC);
  }
  public function add($qData) {
    $title = $qData['title'];
    $authorId = $qData['author_id'];
    $categoryId = $qData['category_id'];
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
  public function update($qData) {
    $title = $qData['title'];
    $categoryId = $qData['category_id'];
    $content = $qData['content'];
    $id = $qData['id'];
    $answerId = $qData['answer_id'];
    $answer = $qData['answer'];
    $adminId = $qData['admin_id'];

    $sqlUpdate = "
    UPDATE questions q, answers an
    SET 
      q.title='$title',
      q.category_id=$categoryId,
      q.content='$content',
      q.answer_id = $answerId,
      an.content = '$answer',
      an.admin_id = $adminId
    WHERE q.id=$id";
    return $this->request($sqlUpdate)->fetchAll(PDO::FETCH_ASSOC);
  }
  public function delete($id) {
    $sqlDel = "
    DELETE FROM questions
    WHERE id='$id' 
    LIMIT 1";
    return $this->request($sqlDel)->fetchAll(PDO::FETCH_ASSOC);
  }
  public function groupDelete($categoryId) {
    $sqlDel = "
    DELETE questions, answers
    FROM questions
    LEFT JOIN answers
    ON questions.answer_id=answers.id
    WHERE questions.category_id='$categoryId' 
";
    return $this->request($sqlDel)->fetchAll(PDO::FETCH_ASSOC);
  }
  public function showToggle($id) {
    $sqlShowToggle = "UPDATE questions SET is_show=NOT is_show WHERE id='$id' LIMIT 1";
    return $this->request($sqlShowToggle)->fetchAll(PDO::FETCH_ASSOC);
  }
}
