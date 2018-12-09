<?php

class CategoriesModel {
  private $pdo;
  public function __construct($pdo) {
    $this->pdo = $pdo;
  }
  public function categoriesList($sort, $dir, $status = '1') {
    $status = $status === '1' ? $status : 'q.is_show';
    if($dir === 'acs') {
      $dir = 'acs';
    } elseif($dir === 'desc') {
      $dir = 'desc';
    } else {
      $dir = '';
    }
    $sqlCatList = "
    SELECT 
      c.id as id, 
      c.title as title,
      COUNT(q.id) as count_q,
      COUNT(q2.id) as public_q,
      (COUNT(q.id) - COUNT(q2.id)) as waiting_q
    FROM categories c
    LEFT OUTER JOIN questions q 
      ON q.category_id=c.id AND q.is_show=:status
    LEFT OUTER JOIN questions q2 
      ON q2.category_id=c.id AND q.is_show='1'
    GROUP BY c.id
    order by :sort $dir";

    $stmt = $this->pdo->prepare($sqlCatList);
    $stmt->execute(["sort" => $sort, "status" => $status]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  public function isExists($title) {
    $sqlIsExists = "SELECT id FROM categories WHERE title=:title LIMIT 1";
    $stmt = $this->pdo->prepare($sqlIsExists);
    $stmt->execute(["title" => $title]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  public function add($title) {
    $sqlAdd = "INSERT INTO categories SET title=':title'";
    $sqlLastId = "SELECT @@IDENTITY";

    $stmt = $this->pdo->prepare($sqlAdd);
    $stmt->execute(["title" => $title]);
    $stmt->fetchAll();

    $stmt = $this->pdo->prepare($sqlLastId);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  public function rename($id, $title) {
    $sqlRename = "
    UPDATE categories 
    SET title=:title 
    WHERE id=:id 
    LIMIT 1";

    $stmt = $this->pdo->prepare($sqlRename);
    $stmt->execute(["id" => $id, "title" => $title]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  public function delete($id) {
    $sqlDel = "DELETE FROM categories WHERE id=:id LIMIT 1";
    $stmt = $this->pdo->prepare($sqlDel);
    $stmt->execute(["id" => $id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}
