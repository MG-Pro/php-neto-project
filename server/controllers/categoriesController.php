<?php
include_once 'models/categoriesModel.php';

class CategoriesController {
  private $msg = null;
  private $dir;
  private $categoriesModel;
  public function __construct($pdo) {
    $this->categoriesModel = new CategoriesModel($pdo);
  }
  public function toCategories($login, $list, $msgClass = null) {
    render('admin/admin-header.php', ['adminName' => $login]);
    render('admin/admin-panel.php');
    render('message.php', ['msg' => $this->msg, 'msgClass' => $msgClass]);
    render('admin/admin-categories.php', [
      'categoriesList'=> $list,
      'dir' => $this->dir,
      ]);
  }
  public function sortToggle($dir) {
    return $dir === 'asc' ? 'desc' : 'asc';
  }
  public function categoriesList($login, $sort = 'title', $dir = 'asc') {
    $this->dir = $this->sortToggle($dir);
    $list = $this->categoriesModel->categoriesList($sort, $this->dir);
    if(count($list) === 0) {
      $this->msg = 'Пока нет категорий';
      $this->toCategories($login, [], 'alert-secondary');
    } else {
      $this->toCategories($login, $list);
    }
  }


}
