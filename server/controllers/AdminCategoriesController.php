<?php
include_once 'models/CategoriesModel.php';

class AdminCategoriesController {
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
  public function toRenameForm($login, $id, $title, $msgClass = null) {
    render('admin/admin-header.php', ['adminName' => $login]);
    render('admin/admin-panel.php');
    render('message.php', ['msg' => $this->msg, 'msgClass' => $msgClass]);
    render('admin/admin-categories-rename.php', ['id' => $id, 'title' => $title]);
  }
  public function sortToggle($dir) {
    return $dir === 'asc' ? 'desc' : 'asc';
  }
  public function categoriesList($login, $msgClass = null, $sort = 'title', $dir = 'asc') {
    $this->dir = $this->sortToggle($dir);
    $list = $this->categoriesModel->categoriesList($sort, $this->dir, '0');
    if(count($list) === 0) {
      $this->msg = 'Пока нет категорий';
      $this->toCategories($login, [], 'alert-secondary');
    } else {
      $calcList = [];
      foreach ($list as $key => $item) {
        $calcList[$key] = $item;
        $calcList[$key]['waiting_q'] = (int)$item['count_q'] - (int)$item['public_q'];
      }

      $this->toCategories($login, $list, $msgClass);
    }
  }
  public function add($login, $title) {
    if(strlen($title) < 2) {
      $this->msg = "Имя категории не может быть короче 2 символов";
      $this->categoriesList($login, 'alert-danger');
    } else {
      $cat = $this->categoriesModel->isExists($title);
      if(count($cat) !== 0) {
        $this->msg = "Категория с именем $title уже существует";
        $this->categoriesList($login, 'alert-danger');
      } else {
        $this->categoriesModel->add($title);
        $this->categoriesList($login);
      }
    }
  }
  public function rename($login, $id, $title) {
    if(strlen($title) < 2) {
      $this->msg = "Имя категории не может быть короче 2 символов";
      $this->toRenameForm($login, $id, 'alert-danger');
    } else {
      $cat = $this->categoriesModel->isExists($title);
      if(count($cat) !== 0) {
        $this->msg = "Категория с именем $title уже существует";
        $this->toRenameForm($login, $id, $title, 'alert-danger');
      } else {
        $this->categoriesModel->rename($id, $title);
        $this->msg = 'Имя категории измененено';
        $this->categoriesList($login, $msgClass = 'alert-success');
      }
    }
  }
  public function delete($login, $id, $title) {
    $this->categoriesModel->delete($id);
    $this->msg = "Категория '$title' удалена";
    $this->categoriesList($login, $msgClass = 'alert-success');
  }
}
