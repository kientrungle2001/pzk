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
    <div class="col">
      <h2 class="lead"><?php echo html_escape($item['title']) ?></h2>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <div>
            <?php $data->displayChildren('all');?>
      </div>
    </div>
  </div>
</section>