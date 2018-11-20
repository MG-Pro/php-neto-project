<?php if ($msg !== null): ?>
  <div class="container">
    <div class="row mt-3">
      <div class="col">
        <div class="alert <?php echo $msgClass !== null ? $msgClass : 'd-none' ?>"><?php echo $msg ?></div>
      </div>
    </div>
  </div>
<?php endif; ?>
