<div class="container">
  <div class="row">
    <?php render('/front/sidebar.php', ['catList' => $catList, 'activeCat'=> $activeCat])  ?>
    <?php render('/front/content.php', ['questionList' => $questionList, 'msg' => $msg, 'msgClass' => $msgClass])  ?>
  </div>
</div>

