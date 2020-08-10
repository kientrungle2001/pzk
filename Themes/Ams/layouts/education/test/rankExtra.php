<?php
$items = $data->getItems();
$countItems = $data->getCountItems();
$pages = ceil($countItems / $data->pageSize);
$parent = _db()->getTableEntity('tests')->load($data->get('parentId'), 1800);
?>
<div class="container">
<div class="row">
<div class="col-xs-12">
<h1 class="text-center"> Bảng xếp hạng cho <?php echo $parent->get('name')?></h1>
<div class="table-responsive">
<table class="table">
<tr>
<th>#</th>
<th>Mã học sinh</th>
<th>Tên học sinh</th>
<th>Điểm bài 1</th>
<th>Điểm bài 2</th>
<th>Tổng điểm</th>
<th>Thời gian làm bài</th>
</tr>
<?php  $index = 1; ?>
<?php foreach($items as $item): ?>
<tr>
<td><?php  echo ($index + $data->pageNum * $data->pageSize) ?></td>
<td><?php echo @$item['username']?></td>
<td><?php echo @$item['name']?></td>
<td><?php echo @$item['test1Mark']?></td>
<td><?php echo @$item['test2Mark']?></td>
<td><?php echo @$item['totalMark']?></td>
<td><?php  echo time_duration($item['duringTime']); ?></td>
</tr>
<?php  $index++; ?>
<?php endforeach; ?>
</table>
Trang 
<?php 
for($i = 0; $i < $pages; $i++):
?>
<a class="btn <?php if($i == $data->pageNum): ?>btn-primary<?php else: ?>btn-default<?php endif; ?>" href="/Compability/rank/5/<?php echo @$data->parentId?>?page=<?php echo $i ?>">
	<?php  echo ($i + 1) ?>
</a>
<?php endfor;?>
<br /><br />
</div>
</div>
</div>
</div>