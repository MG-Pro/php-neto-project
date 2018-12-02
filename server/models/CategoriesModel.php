<?php
class CategoriesModel {
  private $pdo;
  public function __construct($pdo) {
    $this->pdo = $pdo;
  }
  private function request($sql) {
    return $this->pdo->query($sql);
  }
  public function categoriesList($sort, $dir, $status = '1') {
    $status = $status === '1' ? $status : 'q.is_show';
    $sqlCatList = "
    SELECT 
      c.id as id, 
      c.title as title,
      COUNT(q.id) as count_q,
      COUNT(q2.id) as public_q,
      (COUNT(q.id) - COUNT(q2.id)) as waiting_q
    FROM categories c
    LEFT OUTER JOIN questions q 
      ON q.category_id=c.id AND q.is_show=$status
    LEFT OUTER JOIN questions q2 
      ON q2.category_id=c.id AND q.is_show='1'
    GROUP BY c.id
    order by $sort $dir";
    return $this->request($sqlCatList)->fetchAll(PDO::FETCH_ASSOC);
  }
  public function isExists($title) {
    $sqlIsExists = "SELECT id FROM categories WHERE title='$title' LIMIT 1";
    return $this->request($sqlIsExists)->fetchAll(PDO::FETCH_ASSOC);
  }
  public function add($title) {
    $sqlAdd = "INSERT INTO categories SET title='$title'";
    $sqlLastId = "SELECT @@IDENTITY";
    $this->request($sqlAdd)->fetchAll(PDO::FETCH_ASSOC);
    return $this->request($sqlLastId)->fetchAll(PDO::FETCH_ASSOC);
  }
  public function rename($id, $title) {
    $sqlRename = "
    UPDATE categories 
    SET title='$title' 
    WHERE id=$id 
    LIMIT 1";
    return $this->request($sqlRename)->fetchAll(PDO::FETCH_ASSOC);
  }
  public function delete($id) {
    $sqlDel = "DELETE FROM categories WHERE id='$id' LIMIT 1";
    return $this->request($sqlDel)->fetchAll(PDO::FETCH_ASSOC);
  }
}
