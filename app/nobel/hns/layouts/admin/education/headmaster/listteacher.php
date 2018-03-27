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
	{each $listTeachers as $teacher}
		<tr>
			<td>{teacher[id]}</td>
			<td>{teacher[name]}</td>
			<td>{teacher[fullName]}</td>
			<td>{teacher[phone]}</td>
		</tr>
	{/each}
	</table>
<?php } ?>	