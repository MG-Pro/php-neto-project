<header class="header navbar navbar-dark bg-dark navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand" href="index.php?admin=signin">FAQ | Admin</a>
    <ul class="navbar-nav ml-auto">
      <li>
        <a class="nav-link" target="_blank" href="index.php">Интерфейс пользователя</a>
      </li>
      <?php if($adminName !== null): ?>
        <li>
          <a class="nav-link" href="index.php?admin=signout"><?php echo $adminName ?> (Выйти)</a>
        </li>
      <?php endif; ?>
    </ul>
  </div>
</header>

