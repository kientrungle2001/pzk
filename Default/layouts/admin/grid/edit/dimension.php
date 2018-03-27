{? 
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
?}
<div id="dimension-{? echo $data->get('index')?}-{rand}" class="col-xs-{xssize} col-md-{mdsize}">
	<input id="input-{? echo $data->get('index')?}-{rand}" type="hidden" name="{? echo $data->get('index')?}" value="{? echo html_escape($value)?}" />
	<div class="form-group clearfix">
		<div class="clearfix">
			<label for="{? echo $data->get('index')?}{rand}">{? echo $data->get('label')?}</label>
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
					<input onchange="dimension_change_{? echo $data->get('index')?}_{rand}()" class="form-control" name="{? echo $data->get('index')?}_flat[col{i}][]" />
				<?php endif; ?>
			</div>
			<?php endfor;?>
			<div class="dimension-col col-sm-2">
				<input onchange="dimension_change_{? echo $data->get('index')?}_{rand}()" class="form-control" name="{? echo $data->get('index')?}_flat[value][]" />
			</div>
			<div class="dimension-col col-sm-2">
				<a href="#" onclick="dimension_remove_row_{? echo $data->get('index')?}_{rand}(this); return false;">Remove</a>
				|
				<a href="#" onclick="dimension_up_row_{? echo $data->get('index')?}_{rand}(this); return false;">Up</a>
				|
				<a href="#" onclick="dimension_down_row_{? echo $data->get('index')?}_{rand}(this); return false;">Down</a>
			</div>
		</div>
		<div id="dimension-last-row-{? echo $data->get('index')?}-{rand}" class="dimension-last-row row">
			<div class="col-xs-12">
				<input class="btn btn-primary" onclick="dimension_append_row_{? echo $data->get('index')?}_{rand}();" type="button" value="Add" />
			</div>
		</div>
	</div>
</div>

<script>
	function dimension_append_row_{? echo $data->get('index')?}_{rand}() {
		var dimension_row_html = '';
		var $last_row = $('#dimension-{? echo $data->get('index')?}-{rand} .dimension-row:last');
		$('#dimension-last-row-{? echo $data->get('index')?}-{rand}').before($last_row.clone());
	}
	function dimension_remove_row_{? echo $data->get('index')?}_{rand}(elem) {
		$(elem).parents('.dimension-row').remove();
		dimension_change_{? echo $data->get('index')?}_{rand}();
	}
	function dimension_up_row_{? echo $data->get('index')?}_{rand}(elem) {
		var $row = $(elem).parents('.dimension-row');
		var $prev = $row.prev();
		if($prev.hasClass('dimension-row')) {
			$prev.before($row);
		}
		dimension_change_{? echo $data->get('index')?}_{rand}();
	}
	function dimension_down_row_{? echo $data->get('index')?}_{rand}(elem) {
		var $row = $(elem).parents('.dimension-row');
		var $next = $row.next();
		if($next.hasClass('dimension-row')) {
			$next.after($row);
		}
		dimension_change_{? echo $data->get('index')?}_{rand}();
	}
	function dimension_get_data_{? echo $data->get('index')?}_{rand}() {
		var formData = $('form').serializeForm();
		var fieldData = formData.{? echo $data->get('index')?}_flat;
		
		var result = {};
		var serialize = [];
		for(var i = 0; i < fieldData.value.length; i++) {
			serialize.push({value: fieldData.value[i], name: "data<?php for($i = 0; $i < $deep; $i++):?>["+fieldData.col{i}[i]+"]<?php endfor;?>"});
		}
		result = serialize_form(serialize);
		result = result.data;
		return result;
	}
	function dimension_set_data_{? echo $data->get('index')?}_{rand}(data) {
		var rows = count_json_{? echo $data->get('index')?}_{rand}(data);
		for(var i = 0; i < rows - 1; i++) {
			dimension_append_row_{? echo $data->get('index')?}_{rand}();
		}
		var flat_data = dimension_flat_data_{? echo $data->get('index')?}_{rand}(data);
		for(var i = 0; i < flat_data.length; i++) {
			var $row = $('#dimension-{? echo $data->get('index')?}-{rand} .dimension-row:eq('+i+')');
			for(var j = 0; j < flat_data[i].length; j++) {
				var $col = $row.find('.dimension-col:eq('+j+') input,.dimension-col:eq('+j+') select');
				$col.val(flat_data[i][j]);
			}
		}
	}
	
	function count_json_{? echo $data->get('index')?}_{rand}(data) {
		if(typeof data == 'array') return data.length;
		if(typeof data == 'string' || typeof data == 'number') return 1;
		if(typeof data == 'object') {
			var multiple = 0; 
			for(var i in data) {
				multiple += count_json_{? echo $data->get('index')?}_{rand}(data[i]);
			}
			return multiple;
		}
		
	}
	
	function dimension_flat_data_{? echo $data->get('index')?}_{rand}(data) {
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
					var sub_flat = dimension_flat_data_{? echo $data->get('index')?}_{rand}(data[i]);
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
	dimension_set_data_{? echo $data->get('index')?}_{rand}({value});
	<?php endif;?>
	function dimension_change_{? echo $data->get('index')?}_{rand}() {
		$('#input-{? echo $data->get('index')?}-{rand}').val(JSON.stringify(dimension_get_data_{? echo $data->get('index')?}_{rand}()));
	}
</script>