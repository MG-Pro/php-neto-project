<?php
class CategoriesModel {
  private $pdo;
  public function __construct($pdo) {
    $this->pdo = $pdo;
  }
  private function request($sql) {
    return $this->pdo->query($sql);
  }
  public function categoriesList($sort) {
    $sqlCatList = "SELECT id, title FROM categories order by $sort";
    return $this->request($sqlCatList)->fetchAll(PDO::FETCH_ASSOC);
  }


}
