<!--? $items = $data->getItems(); ?-->
<div class="row">
<!--each $items as $item-->
<div class="col-xs-3 text-center">
	<span class="glyphicon glyphicon-folder-open" style="font-size: 72px; color: blue;"></span>
	<h4>{item[name]}</h4>
	<div class="link-icons">
		<a href="/admin_directory_theme/layoutDetail/{item[id]}">Chi tiết</a> | <a href="/admin_site_layout/del/{item[id]}&backHref=/admin_directory_theme/detail/{data.getThemeId()}">Xóa</a>
	</div>
</div>
<!--/each-->
<div class="col-xs-3 text-center">
	<span class="glyphicon glyphicon-folder-open" style="font-size: 72px; color: blue;"></span>
	<h4><a href="/admin_site_layout/add?theme={data.getParentId()}&hidden_theme=1&backHref=<?php echo urlencode('/admin_directory_theme/detail/'. $data->getThemeId());?>">Add New Layout</a></h4>
</div>
</div>