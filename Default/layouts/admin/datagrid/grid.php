<?php
$controller = pzk_controller();
$request = pzk_request();

$sortFields = $data->getSortFields();
$listSettingType = $data->getListSettingType();
$listFieldSettings = $data->getListFieldSettings();

$orderBy = $data->getOrderBy();
$pageSize = $data->getPageSize();

$actions = $data->getActions();


$objectJs 	=	$data->getJsObjectFields();

?>
<style type="text/css">
h4 {
	font-size: 14px!important;
}
</style>
<div class="row">
	
	<div id="grid-list" class="col-sm-12">
		<!-- Show data -->
		<div class="panel panel-default">
			
			<table id="admin_table_<?php echo $data->get('id')?>" class="table table-hover table-bordered table-striped table-condensed">
				<thead>
				<tr>
					<th><input type="checkbox" id="selecctall"/></th>
					<th>#</th>
					<?php foreach($listFieldSettings as $field): ?>
					<th>
					<span title="<?php echo @$field['label']?>" class="glyphicon glyphicon-remove-circle column-toogle-<?php echo @$field['index']?>" style="cursor: pointer;" onclick="pzk_list.toogleDisplay('<?php echo @$field['index']?>');"></span>
					<?php  if ($field['type'] == 'ordering') { ?>
						<span class="glyphicon glyphicon-floppy-disk" style="cursor: pointer;" onclick="pzk_list.saveOrdering('<?php echo @$field['index']?>');"></span>
					<?php  } ?>
					<span class="column-header-<?php echo @$field['index']?>">
					<?php  if ($field['type'] != 'group') { ?>
					<a href="#" onclick="pzk_list.toggleOrderBy('<?php echo @$field['index']?>'); return false;"><?php echo @$field['label']?></a>
					<?php  } else { ?>
						<?php echo @$field['label']?>
					<?php  } ?>
					<?php  if(@$field['filter']) { ?>
					<?php 
						$filterField = @$field['filter'];
						$filterFieldObj = pzk_obj_once ( 'Core.Db.Grid.Edit.' . ucfirst($filterField ['type']) );
						foreach ( $filterField as $key => $val ) {
							$filterFieldObj->set ( $key, $val );
						}
						$filterFieldObj->setLayout ( 'admin/grid/index/filter/' . $filterField ['type'] );
						$value = $controller->getFilterSession ()->get ( $filterField ['index'] );
						$filterFieldObj->setValue ( $value );
						$filterFieldObj->display ();
					?>
					<?php  } ?>
					</span>
					&nbsp;<span class="column-sorter-<?php echo @$field['index']?> glyphicon glyphicon-chevron-up" style="cursor: pointer;"></span>
					</th>
					<?php endforeach; ?>
					<th>Hành động</th>
				</tr>
				</thead>
				<tbody>

				</tbody>
			</table>
			<div class="panel-footer item">
				<div  id="griddelete" style="margin-left: 10px;" class="btn  btn-sm pull-right btn-danger" >
					<span class="glyphicon glyphicon-remove"></span>Xóa tất
				</div>

				<a class="btn  btn-sm btn-primary pull-right" href="<?php echo BASE_REQUEST . '/admin' ?>_{data.getModule()}/add"><span class="glyphicon glyphicon-plus"></span>{data.getAddLabel()}</a>

				<div>
				<?php $data->displayChildren('[role=export]') ?>
				</div>


			</div>
		</div>
	</div>
</div>

<script>
var listFieldSettings 	= <?php echo json_encode($listFieldSettings);?>;
</script>
{jstmpl grid_column_text}
	(* 
		var row 	= 	data.row;
		var field	=	data.field;
	*)
	(*= row[field.index] *)
{/jstmpl grid_column_text}

{jstmpl grid_column_group}
	(* 
		var row 	= 	data.row;
		var field	=	data.field;
	*)
	(*= row[field.index] *)
{/jstmpl grid_column_group}

{jstmpl grid_column_status}
	(* 
		var row 	= 	data.row;
		var field	=	data.field;
	*)
	(*= row[field.index] *)
{/jstmpl grid_column_status}

{jstmpl grid_column_image}
	(* 
		var row 	= 	data.row;
		var field	=	data.field;
	*)
	<img src="(*= row[field.index] *)" style="width: 80px; height: auto;" />
{/jstmpl grid_column_image}

{jstmpl grid_row}
(* for(var j = 0; j < data.length; j++) { *)
	(* var row = data[j]; *)
	<tr>
	<td><input type="checkbox" /></td>
	<td>(*= row.id*)</td>
	(* for(var i = 0; i < listFieldSettings.length; i++){ *)
		(* var field = listFieldSettings[i]; *)
		<td>
			(* 
			var type = 'grid_column_' + field.type;
			var columnHtml = pzk.tmpl(window[type], {row: row, field: field});
			*)
		</td>
	(* } *)
	<td>Action</td>
	</tr>
(* } *)
{/jstmpl grid_row}

<script>
pzk.beforeload('<?php echo $data->get('id')?>', function(){
	var objectJs = <?php echo json_encode($objectJs)?>;
	$.extend(this, objectJs);
});
</script>