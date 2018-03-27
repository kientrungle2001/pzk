{? 
$rand 		= rand(1, 100);
$xssize 	= pzk_or($data->get('xssize'), 12);
$mdsize 		= pzk_or($data->get('mdsize'), 12);
?}
<div class="col-xs-{xssize} col-md-{mdsize}">
	<div class="form-group clearfix">
		<label for="{? echo $data->get('index')?}{rand}">{? echo $data->get('label')?}</label> <select
			 multiple="multiple" class="select2-container js-states form-control select2"
			id="{? echo $data->get('index')?}{rand}" name="{? echo $data->get('index')?}[]" size="10">
        <?php
								$parents = _db ()->select ( pzk_or($data->get ('fields'), '*') )->from ( $data->get('table') )->where ( pzk_or ( @$data->get ('condition'), '1' ) )->result ();
								if (isset ( $parents [0] ['parent'] )) {
									$parents = treefy ( $parents, 'parent', 0 );
									echo "<option value='0'>&nbsp;&nbsp;&nbsp;&nbsp;Danh mục gốc</option>";
								} else {
									echo "<option value='0'>Danh mục gốc</option>";
								}
								?>
        {each $parents as $parent}
        <?php
								$selected = '';
								$trimIds = trim ( $data->get('value'), ',' );
								$arrIds = explode ( ',', $trimIds );
								if (in_array ( $parent [$data->get('show_value')], $arrIds )) {
									$selected = 'selected="selected"';
								}
								?>
        <option <?php echo $selected; ?>
				value="<?php echo $parent[$data->get('show_value')]; ?>">
            <?php if(isset($parent['parent'])){ echo str_repeat('--', $parent['level']); } ?>
            #{parent[id]} - <?php echo $parent[$data->get('show_name')]; ?>
        </option> {/each}

		</select>
		<script type="text/javascript">
		$('#{? echo $data->get('index')?}{rand}').select2( { placeholder: "{? echo $data->get('label')?}", allowClear: true, closeOnSelect: false } );
		</script>
		<style>
		.select2-results .select2-selected {
			display: block;
		}
		.select2-results .select2-selected .select2-result-label {
			background: #ccc;
		}
		</style>
	</div>
</div>