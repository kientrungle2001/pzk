<?php
$item = $data->getItem();
?>
<h3>Câu hỏi: <?php echo @$item['name']?></h3>
<div class="row">
<div class="col-lg-12">
<a class="btn btn-primary" href="<?php echo BASE_REQUEST . '/admin_' ?><?php  echo pzk_request()->getController(); ?>/edit/<?php echo @$item['id']?>">Sửa</a>
<a class="btn btn-default" href="<?php echo BASE_REQUEST . '/admin_' ?><?php  echo pzk_request()->getController(); ?>/index">Trở lại</a>
</div>
</div>
<?php $data->displayChildren('all') ?>