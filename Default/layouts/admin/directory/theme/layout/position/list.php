<!--? 
$positions = $data->getItems();
 ?-->
<div class="container">
	<div class="row">
	<!--each $positions as $position-->
		<div class="col-sm-3 text-center">
		<span class="glyphicon glyphicon-folder-open" style="font-size: 72px; color: blue;"></span>
		<h4>{position[position]}</h4>
		<div class="link-icons">
			<a href="/admin_directory_theme/delPosition/{position[id]}">Xóa</a>
		</div>
		</div>
	<!--/each-->
		<div class="col-sm-3 text-center">
		<span class="glyphicon glyphicon-folder-open" style="font-size: 72px; color: blue;"></span>
		<h4><a href="/admin_site_layoutposition/add?theme={data.getThemeName()}&layout={data.getLayoutName()}&hidden_theme=1&hidden_layout=1&backHref=<?php echo urlencode(BASE_REQUEST . '/admin_directory_theme/layoutDetail/'.$data->getLayoutId());?>">Add New Position</a></h4>
		
		</div>
	</div>
	
</div>