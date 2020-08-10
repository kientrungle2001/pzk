<?php $items = $data->getItems(); ?>
<div class="row">
<!--each $items as $item-->
<div class="col-xs-3 text-center">
	<span class="glyphicon glyphicon-folder-open" style="font-size: 72px; color: blue;"></span>
	<h4><?php echo @$item['controller_name']?>/<?php echo @$item['action_name']?></h4>
	<div class="link-icons">
		<a href="/Admin_Site_Controllerlayout/design/<?php echo @$item['id']?>">Thiết kế trang</a> | <a href="/Admin_Site_Controllerlayout/del/<?php echo @$item['id']?>&backHref=/admin_directory_theme/detail/{data.getThemeId()}">Xóa</a>
	</div>
</div>
<!--/each-->
<div class="col-xs-3 text-center">
	<span class="glyphicon glyphicon-folder-open" style="font-size: 72px; color: blue;"></span>
	<h4><a href="/Admin_Site_Controllerlayout/add?theme={data.getParentId()}&hidden_theme=1&backHref=<?php echo urlencode('/admin_directory_theme/detail/'. $data->getThemeId());?>">Add New Controller Action</a></h4>
</div>
</div>