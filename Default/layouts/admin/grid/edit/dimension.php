<?php  
// require_once BASE_DIR . '/lib/string.php';
$rand 		= rand(1, 100);
$xssize 	= pzk_or($data->get('xssize'), 12);
$mdsize 	= pzk_or($data->get('mdsize'), 12);
$deep		= $data->get('deep');
$value		= $data->get('value');
if(strpos($value, '{') !== null) {
	$json = json_decode($value, true);
}
$settings	= pzk_or($data->get('settings'), array());
?>
<div id="dimension-<?php  echo $data->get('index')?>-<?php echo $rand ?>" class="col-xs-<?php echo $xssize ?> col-md-<?php echo $mdsize ?>">
	<input id="input-<?php  echo $data->get('index')?>-<?php echo $rand ?>" type="hidden" name="<?php  echo $data->get('index')?>" value="<?php  echo html_escape($value)?>" />
	<div class="form-group clearfix">
		<div class="clearfix">
			<label for="<?php  echo $data->get('index')?><?php echo $rand ?>"><?php  echo $data->get('label')?></label>
		</div>
		<div class="dimension-row row" style="margin-top: 10px; margin-bottom: 10px;">
			<?php for($i = 0; $i < $deep; $i++):?>
			<div class="dimension-col col-sm-<?php echo pzk_or(@$settings[$i]['mdsize'], 2)?>">
				<?php if(isset($settings[$i])):
					$obj = pzk_obj('Core.Db.Grid.Edit.Dimension.' . ucfirst($settings[$i]['type']));
					$obj->set('index',$data->get('index'));
					$obj->set('colIndex', $i);
					$obj->set('rand', $rand);
					foreach($settings[$i] as $key => $val) {
						$obj->set($key, $val);
					}
					$obj->display();
				else: ?>
					<input onchange="dimension_change_<?php  echo $data->get('index')?>_<?php echo $rand ?>()" class="form-control" name="<?php  echo $data->get('index')?>_flat[col<?php echo $i ?>][]" />
				<?php endif; ?>
			</div>
			<?php endfor;?>
			<div class="dimension-col col-sm-2">
				<input onchange="dimension_change_<?php  echo $data->get('index')?>_<?php echo $rand ?>()" class="form-control" name="<?php  echo $data->get('index')?>_flat[value][]" />
			</div>
			<div class="dimension-col col-sm-2">
				<a href="#" onclick="dimension_remove_row_<?php  echo $data->get('index')?>_<?php echo $rand ?>(this); return false;">Remove</a>
				|
				<a href="#" onclick="dimension_up_row_<?php  echo $data->get('index')?>_<?php echo $rand ?>(this); return false;">Up</a>
				|
				<a href="#" onclick="dimension_down_row_<?php  echo $data->get('index')?>_<?php echo $rand ?>(this); return false;">Down</a>
			</div>
		</div>
		<div id="dimension-last-row-<?php  echo $data->get('index')?>-<?php echo $rand ?>" class="dimension-last-row row">
			<div class="col-xs-12">
				<input class="btn btn-primary" onclick="dimension_append_row_<?php  echo $data->get('index')?>_<?php echo $rand ?>();" type="button" value="Add" />
			</div>
		</div>
	</div>
</div>

<script>
	function dimension_append_row_<?php  echo $data->get('index')?>_<?php echo $rand ?>() {
		var dimension_row_html = '';
		var $last_row = $('#dimension-<?php  echo $data->get('index')?>-<?php echo $rand ?> .dimension-row:last');
		$('#dimension-last-row-<?php  echo $data->get('index')?>-<?php echo $rand ?>').before($last_row.clone());
	}
	function dimension_remove_row_<?php  echo $data->get('index')?>_<?php echo $rand ?>(elem) {
		$(elem).parents('.dimension-row').remove();
		dimension_change_<?php  echo $data->get('index')?>_<?php echo $rand ?>();
	}
	function dimension_up_row_<?php  echo $data->get('index')?>_<?php echo $rand ?>(elem) {
		var $row = $(elem).parents('.dimension-row');
		var $prev = $row.prev();
		if($prev.hasClass('dimension-row')) {
			$prev.before($row);
		}
		dimension_change_<?php  echo $data->get('index')?>_<?php echo $rand ?>();
	}
	function dimension_down_row_<?php  echo $data->get('index')?>_<?php echo $rand ?>(elem) {
		var $row = $(elem).parents('.dimension-row');
		var $next = $row.next();
		if($next.hasClass('dimension-row')) {
			$next.after($row);
		}
		dimension_change_<?php  echo $data->get('index')?>_<?php echo $rand ?>();
	}
	function dimension_get_data_<?php  echo $data->get('index')?>_<?php echo $rand ?>() {
		var formData = $('form').serializeForm();
		var fieldData = formData.<?php  echo $data->get('index')?>_flat;
		
		var result = {};
		var serialize = [];
		for(var i = 0; i < fieldData.value.length; i++) {
			serialize.push({value: fieldData.value[i], name: "data<?php for($i = 0; $i < $deep; $i++):?>["+fieldData.col<?php echo $i ?>[i]+"]<?php endfor;?>"});
		}
		result = serialize_form(serialize);
		result = result.data;
		return result;
	}
	function dimension_set_data_<?php  echo $data->get('index')?>_<?php echo $rand ?>(data) {
		var rows = count_json_<?php  echo $data->get('index')?>_<?php echo $rand ?>(data);
		for(var i = 0; i < rows - 1; i++) {
			dimension_append_row_<?php  echo $data->get('index')?>_<?php echo $rand ?>();
		}
		var flat_data = dimension_flat_data_<?php  echo $data->get('index')?>_<?php echo $rand ?>(data);
		for(var i = 0; i < flat_data.length; i++) {
			var $row = $('#dimension-<?php  echo $data->get('index')?>-<?php echo $rand ?> .dimension-row:eq('+i+')');
			for(var j = 0; j < flat_data[i].length; j++) {
				var $col = $row.find('.dimension-col:eq('+j+') input,.dimension-col:eq('+j+') select');
				$col.val(flat_data[i][j]);
			}
		}
	}
	
	function count_json_<?php  echo $data->get('index')?>_<?php echo $rand ?>(data) {
		if(typeof data == 'array') return data.length;
		if(typeof data == 'string' || typeof data == 'number') return 1;
		if(typeof data == 'object') {
			var multiple = 0; 
			for(var i in data) {
				multiple += count_json_<?php  echo $data->get('index')?>_<?php echo $rand ?>(data[i]);
			}
			return multiple;
		}
		
	}
	
	function dimension_flat_data_<?php  echo $data->get('index')?>_<?php echo $rand ?>(data) {
		if(typeof data == 'array') {
			var rs = [];
			for(var i = 0; i < data.length; i++) {
				rs.push([data[i]]);
			}
			return rs;
		};
		
		if(typeof data == 'object') {
			var multiple = [];
			for(var i in data) {
				if(typeof data[i] == 'object') {
					var sub_flat = dimension_flat_data_<?php  echo $data->get('index')?>_<?php echo $rand ?>(data[i]);
					for(var j = 0; j < sub_flat.length; j++) {
						var arr = [];
						arr.push(i);
						for(var k = 0; k < sub_flat[j].length; k++) {
							arr.push(sub_flat[j][k]);
						}
						multiple.push(arr);
					}
				} else {
					multiple.push([i, data[i]]);
				}
			}
			return multiple;	
		}
		
	}
	
	<?php if($value): ?>
	dimension_set_data_<?php  echo $data->get('index')?>_<?php echo $rand ?>(<?php echo $value ?>);
	<?php endif;?>
	function dimension_change_<?php  echo $data->get('index')?>_<?php echo $rand ?>() {
		$('#input-<?php  echo $data->get('index')?>-<?php echo $rand ?>').val(JSON.stringify(dimension_get_data_<?php  echo $data->get('index')?>_<?php echo $rand ?>()));
	}
</script>