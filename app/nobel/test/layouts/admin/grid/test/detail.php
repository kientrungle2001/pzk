<?php
$item = $data->getItem();
?>
<h3>Loại đề: <?php echo @$item['name']?></h3>
<h3> Danh sách các câu hỏi</h3>
<?php $data->displayChildren('all') ?>