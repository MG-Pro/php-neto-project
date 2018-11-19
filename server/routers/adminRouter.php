<?php
if($_GET['admin'] === 'entry') {
  render('header.php', ['adminName' => '1']);
  render('admin.php', ['adminName' => '1']);
}
