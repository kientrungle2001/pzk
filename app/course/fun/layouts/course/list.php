<?php
$items = $data->getItems();
$cat = _db()->selectAll()->from('categories')->whereId($data->getParentId())->result_one();
?>
<section id="course_detail" class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
      <li class="breadcrumb-item"><a href="/course/list/<?php echo $cat['id'] ?>"><?php echo $cat['name'] ?></a></li>
    </ol>
  </nav>
  <div class="row">
    <?php foreach ($items as $course) : ?>
      <div class="col-md-4">
        <div class="card">
          <a href="/Course/detail/<?php echo $course['id'] ?>">
            <img class="card-img-top" src="<?php echo pzk_or(@$course['img'], 'http://placehold.it/128x96') ?>" alt="<?php echo html_escape($course['title']) ?>">
          </a>
          <div class="card-body">
            <h5 class="card-title"><a href="/Course/detail/<?php echo $course['id'] ?>"><?php echo html_escape($course['title']) ?></a></h5>
            <p class="card-text"><?php echo nl2br(html_escape(@$course['brief'])) ?></p>
            <a href="/Course/detail/<?php echo $course['id'] ?>" class="btn btn-primary">Xem khóa học</a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>