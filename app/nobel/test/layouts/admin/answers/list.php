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
	<?php foreach($items as $item): ?>
	<tr>
		<td><?php echo @$item['id']?></td>
		<td><a href="<?php echo BASE_REQUEST . '/admin_answers/edit' ?>/<?php echo @$item['id']?>"><?php echo @$item['value']?></a></td>
		<td><?php if ($item['valueTrue']) { ?>Đúng<?php } else { ?>Sai<?php } ?></td>
		<td><a class="btn btn-default" href="<?php echo BASE_REQUEST . '/admin_answers/edit' ?>/<?php echo @$item['id']?>">Sửa</a></td>
		<td><a href="<?php echo BASE_REQUEST . '/admin_answers/del' ?>/<?php echo @$item['id']?>">Xóa</td>
	</tr>
	<?php endforeach; ?>
	<tr>
		<td colspan="5"><a class="btn btn-default" href="<?php echo BASE_REQUEST . '/admin_answers/add' ?>/<?php echo @$parent->itemId?>">Thêm câu trả lời</a></td>
	</tr>
</table>