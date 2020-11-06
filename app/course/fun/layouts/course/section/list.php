<?php $sections = $data->getItems()?>
<h2 class="lead">Nội dung khóa học</h2>
<div>
  <ul>
    <?php foreach ($sections as $section) : ?>
      <li>
        <a href="/course/section/<?php echo $data->getParentId() ?>/<?php echo $section['id'] ?>"><?php echo html_escape($section['title']) ?></a>
      </li>
    <?php endforeach; ?>
  </ul>
</div>