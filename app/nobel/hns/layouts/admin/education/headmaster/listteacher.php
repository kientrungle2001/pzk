<?php 
	$listTeachers = $data->getTeachers();
	if($listTeachers){ 
?>
	<h2 class="text-center">Danh sách giáo viên</h2>
	<table class="table table-bordered  table-hovered">
		<tr>
			<th>ID</th>
			<th>Tên đăng nhập</th>
			<th>Họ và tên</th>
			<th>Điện thoại</th>
		</tr>
	<?php foreach($listTeachers as $teacher): ?>
		<tr>
			<td><?php echo @$teacher['id']?></td>
			<td><?php echo @$teacher['name']?></td>
			<td><?php echo @$teacher['fullName']?></td>
			<td><?php echo @$teacher['phone']?></td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php } ?>	