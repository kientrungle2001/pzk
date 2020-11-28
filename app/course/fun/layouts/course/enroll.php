<?php
$item = $data->getItem();
$cat = _db()->selectAll()->fromCategories()->whereId($item['categoryId'])->result_one();
$sections = _db()->selectAll()->from('course_section')->whereCourseId($item['id'])->whereStatus(1)->result();
?>
<section id="course_detail" class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
      <li class="breadcrumb-item"><a href="/course/list/<?php echo $cat['id'] ?>"><?php echo $cat['name'] ?></a></li>
      <li class="breadcrumb-item active" aria-current="page"><?php echo $item['title'] ?></li>
    </ol>
  </nav>
  <div class="row">
    <div class="col-md-4">
      <img src="<?php echo pzk_or(@$item['img'], 'http://placehold.it/640x480'); ?>" class="img-fluid" />
    </div>
    <div class="col-md-8">
      <h2 class="lead"><?php echo html_escape($item['title']) ?></h2>
      <div class="content">
        <?php echo $item['content'] ?>
      </div>
      <div class="enroll"><a href="#" class="btn btn-primary">Đăng ký học</a></div>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <h2>Nội dung khóa học</h2>
      <div>
        <ul>
          <?php foreach ($sections as $section) : ?>
            <li>
              <a href="/course/section/<?php echo $item['id'] ?>/<?php echo $section['id'] ?>"><?php echo html_escape($section['title']) ?></a>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>
</section>