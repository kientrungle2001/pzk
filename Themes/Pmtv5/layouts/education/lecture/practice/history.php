<?php
$items 	= 	$data->getItems();
$index	=	1;
?>
<div class="container" style="background: #fff; margin-top: 15px; margin-bottom: 15px;">
<div class="row">
<div class="col-xs-12">
<h3 class="text-center">Lịch sử học tập</h3>
<table class="table table-bordered">
<thead>
<tr>
	<th>#</th>
	<th>Tên đăng nhập</th>
	<th>Bài</th>
	<th>Bài số</th>
	<th>Tổng số câu</th>
	<th>Số câu đúng</th>
	<th>Thời gian làm bài</th>
	<th>Thời gian</th>
</tr>
</thead>
<tbody>
<?php foreach($items as $item): ?>
<tr>
	<td><?php echo $index ?></td>
	<td><?php echo @$item['username']?></td>
	<td><a href="/<?php echo @$item['categoryAlias']?>"><?php echo @$item['categoryName']?></a></td>
	<td><?php echo @$item['exerciseNum']?></td>
	<td><?php echo @$item['quantity']?></td>
	<td><?php echo @$item['rights']?></td>
	<td><?php  echo time_duration($item['duration']); ?></td>
	<td><?php  echo date('H:i d/m/Y', strtotime($item['created'])); ?></td>
</tr>
<?php  $index++; ?>
<?php endforeach; ?>
</tbody>
</table>
</div>
</div>
</div>
<script type="text/javascript">
$(function() {
	tableitemize();
});
</script>