<?php

class AdminModel {
  private $pdo;
  public function __construct($pdo) {
    $this->pdo = $pdo;
  }
  public function signIn($login, $pas) {
    $sqlSignIn = "SELECT id, login, status FROM admins WHERE login=:login AND pass=:pas LIMIT 1";
    $stmt = $this->pdo->prepare($sqlSignIn);
    $stmt->execute(["login" => $login, "pas" => $pas]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  public function signUp($login, $pas) {
    $sqlSignUp = "INSERT INTO admins SET login=:login, pass=:pas";
    $sqlLastId = "SELECT @@IDENTITY";
    $stmt = $this->pdo->prepare($sqlSignUp);
    $stmt->execute(["login" => $login, "pas" => $pas]);
    $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt = $this->pdo->prepare($sqlLastId);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC)[0]['@@IDENTITY'];
  }
  public function adminList() {
    $sqlAdminList = "SELECT id, login, date_reg, status FROM admins order by date_reg";
    $stmt = $this->pdo->prepare($sqlAdminList);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  public function isSuper ($login) {
    $sqlIsSuper = "SELECT status FROM admins WHERE login=:login AND super=1 LIMIT 1";
    $stmt = $this->pdo->prepare($sqlIsSuper);
    $stmt->execute(["login" => $login]);
    $admin = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return count($admin) !== 0 ? true : false;
  }
  public function statusToggle($login) {
    $sqlStatusToggle = "UPDATE admins SET status=NOT status WHERE login=:login LIMIT 1";
    $stmt = $this->pdo->prepare($sqlStatusToggle);
    $stmt->execute(["login" => $login]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  public function delete($login) {
    $sqlDelAdmin = "DELETE FROM admins WHERE login=:login LIMIT 1";
    $stmt = $this->pdo->prepare($sqlDelAdmin);
    $stmt->execute(["login" => $login]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  public function editPass($id, $pass) {
    $sqlEditPass = "UPDATE admins SET pass=:pass WHERE id=:id LIMIT 1";
    $stmt = $this->pdo->prepare($sqlEditPass);
    $stmt->execute(["id" => $id, "pass" => $pass]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}
