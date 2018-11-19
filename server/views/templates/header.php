<header class="header navbar navbar-dark bg-dark navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand" href="index.php">FAQ</a>
    <ul class="navbar-nav ml-auto">
      <?php if ($adminName): ?>
        <li>
          <a class="nav-link" href="index.php?admin=exit"><?php echo $adminName ?> (Выйти)</a>
        </li>
      <?php else: ?>
        <li>
          <a class="nav-link" href="index.php?admin=entry">Вход для админов</a>
        </li>
      <?php endif; ?>
    </ul>
  </div>
</header>


