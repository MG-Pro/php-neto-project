<?php

include_once 'models/QuestionModel.php';
include_once 'models/CategoriesModel.php';
include_once 'models/AuthorsModel.php';
include_once 'models/AnswerModel.php';

class AdminQuestionController {
  private $msg = null;
  private $questionModel;
  private $categoriesModel;
  private $authorsModel;
  private $answerModel;

  public function __construct($pdo) {
    $this->questionModel = new QuestionModel($pdo);
    $this->categoriesModel = new CategoriesModel($pdo);
    $this->authorsModel = new AuthorsModel($pdo);
    $this->answerModel = new AnswerModel($pdo);
  }

  private function toQuestionList($login, $catList, $qList, $activeCat, $count, $msgClass = null) {
    render('admin/admin-header.php', ['adminName' => $login]);
    render('message.php', ['msg' => $this->msg, 'msgClass' => $msgClass]);
    render('admin/admin-panel.php');
    render('admin/admin-content.php', ['catList' => $catList, 'questionList' => $qList, 'activeCat' => $activeCat, 'count' => $count]);
  }

  private function toEditQuestion($login, $question, $catList, $msgClass = null) {
    render('admin/admin-header.php', ['adminName' => $login]);
    render('message.php', ['msg' => $this->msg, 'msgClass' => $msgClass]);
    render('admin/admin-panel.php');
    render('admin/edit-question.php', ['question' => $question, 'catList' => $catList]);
  }

  public function questionList($login, $categoryId, $filter = null, $msgClass = null) {
    $catList = $this->categoriesModel->categoriesList('title', 'asc', null);
    $count = $this->questionModel->count();

    if ($categoryId === 'all') {
      $qList = $this->questionModel->questionList(null, '0', $filter);
      $this->toQuestionList($login, $catList, $qList, 'all', $count, $msgClass);

    } else {
      if ($categoryId !== null) {
        foreach ($catList as $i => $cat) {
          if ($cat['id'] === $categoryId) {
            $catIndex = $i;
            break;
          }
        }
      } else {
        $catIndex = 0;
      }
      $qList = $this->questionModel->questionList($catList[ $catIndex ]['id'], '0', $filter);
      $this->toQuestionList($login, $catList, $qList, $catList[ $catIndex ]['id'], $count, $msgClass);
    }
  }

  public function editQuestion($login, $id) {
    $catList = $this->categoriesModel->categoriesList('title', 'asc');
    $question = $this->questionModel->question($id);
    $this->toEditQuestion($login, $question[0], $catList);
  }

  public function update($admin, $qData) {
    $catList = $this->categoriesModel->categoriesList('title', 'asc');
    $question = $this->questionModel->question($qData['id'])[0];
    $qData['author_email'] = $question['author_email'];
    $qData['author'] = $question['author'];
    $qData['category'] = $question['category'];
    $login = $admin['login'];
    if (strlen($qData['title']) < 5) {
      $this->msg = 'Заголовок должен быть не короче 5 символов';
      $this->toEditQuestion($login, $qData, $catList, 'alert-danger');
    } elseif (strlen($qData['content']) < 10) {
      $this->msg = 'Содержимое должно быть не короче 10 символов';
      $this->toEditQuestion($login, $qData, $catList, 'alert-danger');
    } elseif (strlen($qData['answer']) < 10) {
      $this->msg = 'Ответ должен быть не короче 10 символов';
      $this->toEditQuestion($login, $qData, $catList, 'alert-danger');
    } else {
      $qData['admin_id'] = $admin['id'];
      if (!$qData['answer_id']) {
        $qData['answer_id'] = $this->answerModel->add($qData['answer'], $admin['id']);
      }
      $this->questionModel->update($qData);
      $this->msg = 'Вопрос обновлен';
      $this->questionList($login, $qData['category_id'], 'alert-success');
    }
  }

  public function deleteQuestion($login, $id) {
    $question = $this->questionModel->question($id)[0];
    if ($question['answer_id'] !== null) {
      $this->answerModel->delete($question['answer_id']);
    }
    $this->questionModel->delete($id);
    $this->msg = 'Вопрос удален';
    $this->questionList($login, $question['category_id'], 'alert-success');
  }

  public function groupDeleteQuestions($categoryId) {
    $this->questionModel->groupDelete($categoryId);
  }

  public function showToggleQuestion($login, $id) {
    $this->questionModel->showToggle($id);
    $this->editQuestion($login, $id);
  }
}

