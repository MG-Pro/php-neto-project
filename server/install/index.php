<?php
define('DB_LOGIN', "mgladkih");
define('DB_PASS', "neto1853");

// define('DB_LOGIN', "root");
// define('DB_PASS', "");
$isInstall = false;
if (isset($_POST['install'])) {
  $pdo = new PDO(
    "mysql:host=localhost;dbname=mgladkih;charset=UTF8",
    DB_LOGIN,
    DB_PASS);

  $sql = file_get_contents('faq.sql');

  $qr = $pdo->exec($sql);
  $isInstall = true;
}

?>
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Install</title>
</head>
<body>
  <?php if (!$isInstall): ?>
  <form action="index.php" method="post">
    <h3>Установка БД</h3>
    <input type="hidden" name="install">
    <button>Установить</button>
  </form>
<?php else: ?>
  <h3>Установка завершена</h3>
<?php endif; ?>
</body>
</html>
