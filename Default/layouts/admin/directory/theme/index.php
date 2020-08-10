<?php 
$themes = $data->getItems();
 ?>
 
 <!--jstmpl tmpl_theme-->
 <h3>Theme (*= data.theme*)</h3>
 <hr />
 <h4><a href="javascript:void(0)" onclick="show_layouts('(*= data.theme*)'); return false;">Layouts</a></h4>
 <div id="layoutPositions">
 
 </div>
 
 <!--/jstmpl tmpl_theme-->
 
 <!--jstmpl tmpl_layout-->
 <hr />
 <h5>Positions: </h5>
 (* var items = data;*)
 <div class="row">
 (* for(var i = 0; i < items.length; i++) { *)
	 <div class="col-sm-3 text-center">
		(* var item = items[i];*)
		<h4>(*= item.name*)</h4>
	 </div>
 (* } *)
 </div>
 <!--/jstmpl tmpl_layout-->
 
 <script>
 function table_model(table, conditions) {
	 return {table: table, fields: '*', conditions: conditions};
 }
 function layout_model(theme) {
	 return table_model('site_layout', ['equal', 'theme', theme]);
 }
 function show_layouts(theme) {
	 $('#layoutPositions').template(tmpl_layout, BASE_REQUEST + '/admin_api_grid/index', layout_model(theme));
 }
 </script>
 
 <div class="container">
	<div class="row">
	<!--each $themes as $theme-->
		<div class="col-sm-3 text-center">
		<a href="/admin_directory_theme/detail/<?php echo @$theme['id']?>">
		<span class="glyphicon glyphicon-folder-open" style="font-size: 72px; color: blue;"></span>
		</a>
		<h2><?php echo @$theme['name']?></h2>
		<div class="link-icons">
			<a href="/admin_directory_theme/detail/<?php echo @$theme['id']?>">Chi tiết</a> |
			<a href="/admin_directory_theme/del/<?php echo @$theme['id']?>">Xóa</a>
		</div>
		</div>
	<!--/each-->
		<div class="col-sm-3 text-center">
		<span class="glyphicon glyphicon-folder-open" style="font-size: 72px; color: blue;"></span>
		<h2><a href="/admin_themes/add?backHref=<?php echo urlencode(BASE_REQUEST . '/admin_directory_theme/index');?>">Add New Theme</a></h2>
		
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12" id="themeDialog"></div>
	</div>
	
</div>