<?php $items = $data->getItems(); 
$parent = $data->getParent();
?>
<table class="table">
	<tr>
		<th>#</th>
		<th>Câu trả lời</th>
		<th>Câu đúng</th>
		<th colspan="2">Hành động</th>
	</tr>
	{each $items as $item}
	<tr>
		<td>{item[id]}</td>
		<td><a href="{url /admin_answers/edit}/{item[id]}">{item[value]}</a></td>
		<td><?php if ($item['valueTrue']) { ?>Đúng<?php } else { ?>Sai<?php } ?></td>
		<td><a class="btn btn-default" href="{url /admin_answers/edit}/{item[id]}">Sửa</a></td>
		<td><a href="{url /admin_answers/del}/{item[id]}">Xóa</td>
	</tr>
	{/each}
	<tr>
		<td colspan="5"><a class="btn btn-default" href="{url /admin_answers/add}/{parent.itemId}">Thêm câu trả lời</a></td>
	</tr>
</table>