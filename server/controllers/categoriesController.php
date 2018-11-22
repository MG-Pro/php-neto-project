<?php
include_once 'models/categoriesModel.php';

class CategoriesController {
  private $msg = null;
  private $categoriesModel;
  public function __construct($pdo) {
    $this->categoriesModel = new CategoriesModel($pdo);
  }
  public function toCategories($login, $list, $msgClass = null) {
    render('admin/admin-header.php', ['adminName' => $login]);
    render('admin/admin-panel.php');
    render('message.php', ['msg' => $this->msg, 'msgClass' => $msgClass]);
    render('admin/admin-categories.php', ['categoriesList'=> $list]);
  }
  public function categoriesList($login) {
    $list = $this->categoriesModel->categoriesList();
    if(count($list) === 0) {
      $this->msg = 'Пока нет категорий';
      $this->toCategories($login, [], 'alert-secondary');
    } else {
      $this->toCategories($login, $list);
    }
  }


}
