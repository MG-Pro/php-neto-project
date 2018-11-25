<div class="sidebar col-3 border-right">
  <h5 class="mt-2 mb-3">Категории</h5>
  <div class="list-group">
    <?php foreach ($catList as $cat): ?>
      <a class="list-group-item list-group-item-action" href=""><?php echo $cat['title'] ?></a>
    <?php endforeach; ?>
  </div>
</div>

