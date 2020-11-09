<!-- A vertical navbar -->

<?php
$activeCourseId = $data->getActiveCourseId();
$items = _db()->selectAll()->fromCategories()->whereStatus(1)->result();
?>
<!-- Links -->
<ul class="nav flex-column">
  <?php foreach ($items as $item) : ?>
    <li class="nav-item">
      <a class="nav-link <?php if ($activeCourseId && ($activeCourseId == $item['id'])) : ?>active<?php endif; ?>" href="/course/list/<?php echo $item['id'] ?>"><?php echo $item['name'] ?></a>
    </li>
  <?php endforeach; ?>
</ul>