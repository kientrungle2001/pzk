<!-- A vertical navbar -->
<nav class="navbar bg-light">
  <?php $items = _db()->selectAll()->fromCategories()->whereStatus(1)->result(); ?>
  <!-- Links -->
  <ul class="navbar-nav">
  <?php foreach($items as $item):?>
    <li class="nav-item">
      <a class="nav-link" href="/course/list/<?php echo $item['id']?>"><?php echo $item['name']?></a>
    </li>
  <?php endforeach;?>
  </ul>

</nav>