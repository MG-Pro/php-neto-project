<?php
include_once 'models/categoriesModel.php';

class CategoriesController {
  public $msg = '';
  private $categoriesModel;
  public function __construct($pdo) {
    $this->categoriesModel = new CategoriesModel($pdo);
  }
}
