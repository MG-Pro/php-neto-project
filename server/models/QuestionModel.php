<?php

class QuestionModel {
  private $pdo;

  public function __construct($pdo) {
    $this->pdo = $pdo;
  }

  public function questionList($categoryId, $status = '1', $filter = '') {
    $status = $status === '1' ? $status : 'q.is_show';
    $categoryId = $categoryId ? $categoryId : 'q.category_id';
    if ($filter === 'unanswered') {
      $filter = 'AND an.content IS NULL';
    } elseif ($filter === 'answered') {
      $filter = 'AND an.content IS NOT NULL';
    } else {
      $filter = '';
    }
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
    WHERE q.category_id=$categoryId 
      AND q.is_show=$status
      $filter
    order by q.date_added";

    $stmt = $this->pdo->prepare($sqlQuestionList);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    WHERE q.id=:id 
    LIMIT 1";
    $stmt = $this->pdo->prepare($sqlQuestion);
    $stmt->execute(["id" => $id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function add($qData) {
    $title = $qData['title'];
    $authorId = $qData['author_id'];
    $categoryId = $qData['category_id'];
    $content = $qData['content'];

    $sqlAdd = "
    INSERT INTO questions 
    SET 
      title=:title,
      author_id=:authorId,
      category_id=:categoryId,
      content=:content
    ";

    $stmt = $this->pdo->prepare($sqlAdd);
    $stmt->execute(["title" => $title, "authorId" => $authorId, "categoryId" => $categoryId, "content" => $content]);
    $stmt->fetchAll(PDO::FETCH_ASSOC);
    $sqlLastId = "SELECT @@IDENTITY";
    $stmt = $this->pdo->prepare($sqlLastId);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC)[0]['@@IDENTITY'];
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
      q.title=:title,
      q.category_id=:categoryId,
      q.content=:content,
      q.answer_id = :answerId,
      an.content = :answer,
      an.admin_id = :adminId
    WHERE q.id=:id";

    $stmt = $this->pdo->prepare($sqlUpdate);
    $stmt->execute(["title" => $title, "categoryId" => $categoryId, "content" => $content, "answerId" =>
      $answerId, "answer" => $answer, "adminId" => $adminId, "id" => $id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function delete($id) {
    $sqlDel = "
    DELETE FROM questions
    WHERE id=:id 
    LIMIT 1";
    $stmt = $this->pdo->prepare($sqlDel);
    $stmt->execute(["id" => $id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function groupDelete($categoryId) {
    $sqlDel = "
    DELETE questions, answers
    FROM questions
    LEFT JOIN answers
    ON questions.answer_id=answers.id
    WHERE questions.category_id=:categoryId 
";
    $stmt = $this->pdo->prepare($sqlDel);
    $stmt->execute(["categoryId" => $categoryId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function showToggle($id) {
    $sqlShowToggle = "UPDATE questions SET is_show=NOT is_show WHERE id=:id LIMIT 1";
    $stmt = $this->pdo->prepare($sqlShowToggle);
    $stmt->execute(["id" => $id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  public function count() {
    $sqlCount = "SELECT COUNT(id) as count FROM questions";
    $stmt = $this->pdo->prepare($sqlCount);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC)[0]['count'];
  }
}
