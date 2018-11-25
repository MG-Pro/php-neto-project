<div class="container">
  <div class="row">
    <?php render('/front/sidebar.php', ['catList' => $catList])  ?>
    <?php render('/front/content.php', ['questionList' => $questionList])  ?>
  </div>
</div>

