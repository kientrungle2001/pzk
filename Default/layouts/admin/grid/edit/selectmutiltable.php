{? 
$rand 		= rand(1, 100);
$xssize 	= pzk_or($data->get('xssize'), 12);
$mdsize 		= pzk_or($data->get('mdsize'), 12);
?}
<div class="col-xs-{xssize} col-md-{mdsize}">
	<div class="form-group clearfix">
		<label for="{? echo $data->get('index')?}{rand}">{? echo $data->get('label')?}</label> <select
			class="form-control" id="{? echo $data->get('index')?}{rand}"
			name="{? echo $data->get('index')?}">
            <?php
												$tables = $data->get('tables');
												if (isset ( $tables )) {
													foreach ( $tables as $table ) {
													}
												}
												$parents = _db ()->select ( '*' )->from ( $data->get('table') )->where ( pzk_or ( @$data->get('condition'), '1' ) )->result ();
												if (isset ( $parents [0] ['parent'] )) {
													$parents = buildArr ( $parents, 'parent', 0 );
													echo "<option value='0'>&nbsp;&nbsp;&nbsp;&nbsp;Danh mục gốc</option>";
												} else {
													echo "<option value='0'>" . pzk_or ( @$data->get('selectLabel'), '--Chọn danh mục--' ) . " </option>";
												}
												?>
			{each $parents as $parent}
			<option value="<?php echo $parent[$data->get('show_value')]; ?>">
				<?php if(isset($parent['parent'])){ echo str_repeat('--', $parent['level']); } ?>
				#{parent[id]}<?php echo $parent[$data->get('show_name')]; ?>
			</option> {/each}

		</select>
		<script type="text/javascript">
			$('#{? echo $data->get('index')?}{rand}').val('{? echo $data->get('value')?}');
        </script>
	</div>
</div>