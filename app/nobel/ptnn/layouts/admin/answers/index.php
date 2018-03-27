<?php $items = $data->getItems(); 
?>
<table class="table">
	<tr>
		<th>#</th>
		<th>Tên</th>
		<th>Câu đúng</th>
		<th colspan="3">Hành động</th>
	</tr>
	{each $items as $item}
	<tr>
		<td>{item[id]}</td>
		<td>{item[value]}</td>
		<td>{item[valueTrue]}</td>
		<td><a href="{url /admin_questions/detail}/{item[questionId]}">Câu hỏi</a></td>
		<td><a href="{url /admin_answers/edit}/{item[id]}">Sửa</a></td>
		<td><a href="{url /admin_answers/del}/{item[id]}">Xóa</td>
	</tr>
	{/each}
	<tr>
		<td colspan="6"><a href="{url /admin_answers/add}">Thêm câu trả lời</a></td>
	</tr>
</table>