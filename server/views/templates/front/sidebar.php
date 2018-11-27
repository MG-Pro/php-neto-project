<div class="sidebar col-3 border-right">
  <h5 class="mt-2 mb-3">Категории</h5>
  <div class="list-group">
    <?php foreach ($catList as $cat): ?>
    <?php $active = $activeCat === $cat['id'] ? 'active' : '' ?>
      <a class="list-group-item list-group-item-action <?php echo $active?>" href="index.php?question=category&id=<?php echo $cat['id']?>"><?php echo
        $cat['title']
        ?></a>
    <?php endforeach; ?>
  </div>
</div>

