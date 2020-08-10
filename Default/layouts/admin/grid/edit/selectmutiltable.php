<?php  
$rand 		= rand(1, 100);
$xssize 	= pzk_or($data->get('xssize'), 12);
$mdsize 		= pzk_or($data->get('mdsize'), 12);
?>
<div class="col-xs-<?php echo $xssize ?> col-md-<?php echo $mdsize ?>">
	<div class="form-group clearfix">
		<label for="<?php  echo $data->get('index')?><?php echo $rand ?>"><?php  echo $data->get('label')?></label> <select
			class="form-control" id="<?php  echo $data->get('index')?><?php echo $rand ?>"
			name="<?php  echo $data->get('index')?>">
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
			<?php foreach($parents as $parent): ?>
			<option value="<?php echo $parent[$data->get('show_value')]; ?>">
				<?php if(isset($parent['parent'])){ echo str_repeat('--', $parent['level']); } ?>
				#<?php echo @$parent['id']?><?php echo $parent[$data->get('show_name')]; ?>
			</option> <?php endforeach; ?>

		</select>
		<script type="text/javascript">
			$('#<?php  echo $data->get('index')?><?php echo $rand ?>').val('<?php  echo $data->get('value')?>');
        </script>
	</div>
</div>