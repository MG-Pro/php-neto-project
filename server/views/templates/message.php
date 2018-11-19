<div class="row mt-3">
  <div class="col">
    <?php if($msg): ?>
      <div class="alert <?php echo $msgClass ? $msgClass : 'd-none' ?>"><?php echo $msg?></div>
    <?php endif; ?>
  </div>
</div>

