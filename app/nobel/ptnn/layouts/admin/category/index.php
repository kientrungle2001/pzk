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
	{each $items as $item}
	<?php 
	$tab = '&nbsp;&nbsp;&nbsp;&nbsp;';
	$cate = str_repeat($tab, $item['level']).$item['name'];
	?>
	<tr>
		<td>{item[id]}</td>
		<td><a href="{url /admin_category/edit}/{item[id]}">{cate}</a> (
			Route: <a href="{url /}{item[router]}/{item[id]}" target="_blank">{item[router]}</a>
			Alias: <a href="{url /}{item[alias]}-{item[id]}" target="_blank">{item[alias]}</a> )
		</td>
		<td id="status-{item[id]}">
            <?php if($item['status']) { ?><input id="switch-state-{item[id]}" type="checkbox" checked data-size="mini" /><?php }
            else { ?><input id="switch-state-{item[id]}" type="checkbox" data-size="mini" /><?php } ?>
            <script type="text/javascript">jQuery('#switch-state-{item[id]}').bootstrapSwitch({onSwitchChange: function(evt,state) { <?php echo $data->onEvent('changeStatus')?>({id: {item[id]}, status: state}); }})</script>
        </td>
		<!-- <td><a href="{url /admin_category/add}/{item[id]}" class="btn btn-default">Thêm</td> -->
		<td><a href="{url /admin_category/edit}/{item[id]}" class="text-center"><span class="glyphicon glyphicon-edit"></span> Sửa</td>
		<td><a href="{url /admin_category/del}/{item[id]}" class="color_delete text-center" ><span class="glyphicon glyphicon-remove"></span> Xóa</td>
	</tr>
	{/each}
	<tr>
		<td colspan="6"><a href="{url /admin_category/add}" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-plus"></span> Thêm danh mục</a></td>
	</tr>
</table>