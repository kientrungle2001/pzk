<?php $items = $data->getItems(); 
?>
<table class="table">
	<tr>
		<th>#</th>
		<th>Tên</th>
		<th>Câu đúng</th>
		<th colspan="3">Hành động</th>
	</tr>
	<?php foreach($items as $item): ?>
	<tr>
		<td><?php echo @$item['id']?></td>
		<td><?php echo @$item['value']?></td>
		<td><?php echo @$item['valueTrue']?></td>
		<td><a href="<?php echo BASE_REQUEST . '/admin_questions/detail' ?>/<?php echo @$item['questionId']?>">Câu hỏi</a></td>
		<td><a href="<?php echo BASE_REQUEST . '/admin_answers/edit' ?>/<?php echo @$item['id']?>">Sửa</a></td>
		<td><a href="<?php echo BASE_REQUEST . '/admin_answers/del' ?>/<?php echo @$item['id']?>">Xóa</td>
	</tr>
	<?php endforeach; ?>
	<tr>
		<td colspan="6"><a href="<?php echo BASE_REQUEST . '/admin_answers/add' ?>">Thêm câu trả lời</a></td>
	</tr>
</table>