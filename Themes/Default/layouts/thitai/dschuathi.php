<?php
$items = $data->getUsers();
$stt = 1;
?>
<h1 class="text-center">DANH SÁCH THI</h1>
<table class="table table-bordered">
<tr>
	<th>STT</th>
	<th>Tên đăng nhập</th>
	<th>Họ và tên</th>
	<th>Số điện thoại</th>
	<th>Email</th>
	<th>Đợt thi</th>
</tr>
<?php foreach($items as $item): ?>
<tr>
	<td><?php echo $stt ?></td>
	<td><?php echo @$item['username']?></td>
	<td><?php echo @$item['name']?></td>
	<td><?php echo @$item['phone']?></td>
	<td><?php echo @$item['email']?></td>
	<td><?php echo @$item['tests']?></td>
</tr>
<?php  $stt++ ?>
<?php endforeach; ?>
</table>