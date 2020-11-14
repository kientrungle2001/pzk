<?php
$items = _db()->selectAll()->from('categories')->whereStatus(1)->orderBy('ordering asc')->result();
?>
<section id="popular">
  <div class="group-tabs">
    <ul class="nav nav-tabs" role="tablist">
      <?php
      $first = true;
      foreach ($items as $item) : ?>
        <li class="nav-item<?php echo ($first) ? ' active' : ''; ?>" role="presentation">
          <a class="nav-link<?php echo ($first) ? ' active' : ''; ?>" href="#course-category-<?php echo $item['id'] ?>" role="tab" data-toggle="tab"><?php echo $item['name'] ?></a>
        </li>
      <?php
        $first = false;
      endforeach; ?>
    </ul>
    <div class="tab-content py-3 px-3 px-sm-0">
      <?php
      $first = true;
      foreach ($items as $item) : ?>
        <div class="tab-pane fade<?php echo $first ? ' show active' : '' ?>" role="tabpanel" id="course-category-<?php echo $item['id'] ?>">
          <?php echo $item['content'] ?>
          <?php $courses = _db()->selectAll()->from('course')->whereCategoryId($item['id'])->orderBy('ordering asc')->result(); ?>
          <div class="p-3">
            <div class="row">
              <?php foreach ($courses as $course) : ?>
                <div class="col-md-3">
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
          </div>
        </div>
      <?php
        $first = false;
      endforeach ?>
    </div>
  </div>
</section>