<?php
    $items = $data->getItems();
	$items = buildArr($items,'parent',0);
?>
<table class="table">
	<tr>
		<th>#</th>
		<th>Danh mục các dạng bài tập</th>
		<th>Trạng thái</th>
		<th>Hành động</th>
	</tr>
	<?php foreach($items as $item): ?>
	<?php 
	$tab = '&nbsp;&nbsp;&nbsp;&nbsp;';
	$cate = str_repeat($tab, $item['level']).$item['name'];
	?>
	<tr>
		<td><?php echo @$item['id']?></td>
		<td><a href="<?php echo BASE_REQUEST . '/admin_category/edit' ?>/<?php echo @$item['id']?>"><?php echo $cate ?></a> (
			Route: <a href="<?php echo BASE_REQUEST . '/' ?><?php echo @$item['router']?>/<?php echo @$item['id']?>" target="_blank"><?php echo @$item['router']?></a>
			Alias: <a href="<?php echo BASE_REQUEST . '/' ?><?php echo @$item['alias']?>-<?php echo @$item['id']?>" target="_blank"><?php echo @$item['alias']?></a> )
		</td>
		<td id="status-<?php echo @$item['id']?>">
            <?php if($item['status']) { ?><input id="switch-state-<?php echo @$item['id']?>" type="checkbox" checked data-size="mini" /><?php }
            else { ?><input id="switch-state-<?php echo @$item['id']?>" type="checkbox" data-size="mini" /><?php } ?>
            <script type="text/javascript">jQuery('#switch-state-<?php echo @$item['id']?>').bootstrapSwitch({onSwitchChange: function(evt,state) { <?php echo $data->onEvent('changeStatus')?>({id: <?php echo @$item['id']?>, status: state}); }})</script>
        </td>
		<!-- <td><a href="<?php echo BASE_REQUEST . '/admin_category/add' ?>/<?php echo @$item['id']?>" class="btn btn-default">Thêm</td> -->
		<td><a href="<?php echo BASE_REQUEST . '/admin_category/edit' ?>/<?php echo @$item['id']?>" class="text-center"><span class="glyphicon glyphicon-edit"></span> Sửa</td>
		<td><a href="<?php echo BASE_REQUEST . '/admin_category/del' ?>/<?php echo @$item['id']?>" class="color_delete text-center" ><span class="glyphicon glyphicon-remove"></span> Xóa</td>
	</tr>
	<?php endforeach; ?>
	<tr>
		<td colspan="6"><a href="<?php echo BASE_REQUEST . '/admin_category/add' ?>" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-plus"></span> Thêm danh mục</a></td>
	</tr>
</table>