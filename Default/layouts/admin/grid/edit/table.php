<?php
$rand 			= rand(1, 100);
$settings 		= $data->get('settings');
$value			= $data->get('value');
?>

<div id="table-{? echo $data->get('index')?}-{rand}" class="col-xs-{xssize} col-md-{mdsize}">
	<input id="input-{? echo $data->get('index')?}-{rand}" type="hidden" name="{? echo $data->get('index')?}" value="{? echo html_escape($value)?}" />
	<div class="form-group clearfix">
		<div class="clearfix">
			<label for="{? echo $data->get('index')?}{rand}">{? echo $data->get('label')?}</label>
		</div>
		<div class="table-row row" style="margin-top: 10px; margin-bottom: 10px;">
			<?php foreach($settings as $i => $setting):?>
			<div class="table-col col-sm-<?php echo pzk_or(@$setting['mdsize'], 2); ?>">
			<strong>{setting[label]}</strong>
			</div>
			<?php endforeach;?>
		</div>
		<div class="table-row row" style="margin-top: 10px; margin-bottom: 10px;">
			<?php foreach($settings as $i => $setting):?>
			<div class="table-col col-sm-<?php echo pzk_or(@$setting['mdsize'], 2); ?>">
			<?php
					$obj = pzk_obj('Core.Db.Grid.Edit.Table.' . ucfirst($settings[$i]['type']));
					$obj->set('fieldIndex', $data->get('index'));
					$obj->set('colIndex', $i);
					$obj->set('rand', $rand);
					foreach($setting as $key => $val) {
						$obj->set($key, $val);
					}
					$obj->display();
			?>
			</div>
			<?php endforeach;?>
			<div class="table-col col-sm-2">
				<a href="#" onclick="table_remove_row_{? echo $data->get('index')?}_{rand}(this); return false;">Remove</a>
				|
				<a href="#" onclick="table_up_row_{? echo $data->get('index')?}_{rand}(this); return false;">Up</a>
				|
				<a href="#" onclick="table_down_row_{? echo $data->get('index')?}_{rand}(this); return false;">Down</a>
			</div>
		</div>
		<div id="table-last-row-{? echo $data->get('index')?}-{rand}" class="table-last-row row">
			<div class="col-xs-12">
				<input class="btn btn-primary" onclick="table_append_row_{? echo $data->get('index')?}_{rand}();" type="button" value="Add" />
			</div>
		</div>
	</div>
</div>


<script>
	function table_append_row_{? echo $data->get('index')?}_{rand}() {
		var dimension_row_html = '';
		var $last_row = $('#table-{? echo $data->get('index')?}-{rand} .table-row:last');
		$('#table-last-row-{? echo $data->get('index')?}-{rand}').before($last_row.clone());
	}
	
	function table_remove_row_{? echo $data->get('index')?}_{rand}(elem) {
		$(elem).parents('.table-row').remove();
		table_change_{? echo $data->get('index')?}_{rand}();
	}
	
	function table_up_row_{? echo $data->get('index')?}_{rand}(elem) {
		var $row = $(elem).parents('.table-row');
		var $prev = $row.prev();
		if($prev.hasClass('table-row')) {
			$prev.before($row);
		}
		table_change_{? echo $data->get('index')?}_{rand}();
	}
	function table_down_row_{? echo $data->get('index')?}_{rand}(elem) {
		var $row = $(elem).parents('.table-row');
		var $next = $row.next();
		if($next.hasClass('table-row')) {
			$next.after($row);
		}
		table_change_{? echo $data->get('index')?}_{rand}();
	}
	
	function table_set_data_{? echo $data->get('index')?}_{rand}(data) {
		var rows = data.length;
		for(var i = 0; i < rows - 1; i++) {
			table_append_row_{? echo $data->get('index')?}_{rand}();
		}
		
		for(var i = 0; i < rows; i++) {
			var $row = $('#table-{? echo $data->get('index')?}-{rand} .table-row:eq('+(i+1)+')');
			var j = 0;
			for(var k in data[i]) {
				var selector = '.table-col:eq('+j+') input,.table-col:eq('+j+') select';
				var $col = $row.find(selector);
				$col.val(data[i][k]);
				j++;
			}
		}
	}
	
	function table_get_data_{? echo $data->get('index')?}_{rand}() {
		var formData = $('form').serializeForm();
		var fieldData = formData.{? echo $data->get('index')?}_flat;
		var firstKey = null;
		for(var k in fieldData) {
			firstKey = k;
			break;
		}
		var rs = [];
		for(var i = 0; i < fieldData[firstKey].length; i++) {
			var row = {};
			for(var k in fieldData) {
				row[k] = fieldData[k][i];
			}
			rs.push(row);
		}
		return rs;
	}
	
	<?php if($value): ?>
	table_set_data_{? echo $data->get('index')?}_{rand}({value});
	<?php endif;?>
	function table_change_{? echo $data->get('index')?}_{rand}() {
		$('#input-{? echo $data->get('index')?}-{rand}').val(JSON.stringify(table_get_data_{? echo $data->get('index')?}_{rand}()));
	}
</script>