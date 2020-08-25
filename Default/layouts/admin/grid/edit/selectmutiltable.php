<?php  
$rand 		= rand(1, 100);
$xssize 	= pzk_or($data->getXssize(), 12);
$mdsize 		= pzk_or($data->getMdsize(), 12);
?>
<div class="col-xs-<?php echo $xssize ?> col-md-<?php echo $mdsize ?>">
	<div class="form-group clearfix">
		<label for="<?php  echo $data->getIndex()?><?php echo $rand ?>"><?php  echo $data->getLabel()?></label> <select
			class="form-control" id="<?php  echo $data->getIndex()?><?php echo $rand ?>"
			name="<?php  echo $data->getIndex()?>">
            <?php
												$tables = $data->getTables();
												if (isset ( $tables )) {
													foreach ( $tables as $table ) {
													}
												}
												$parents = _db ()->select ( '*' )->from ( $data->getTable() )->where ( pzk_or ( @$data->getCondition(), '1' ) )->result ();
												if (isset ( $parents [0] ['parent'] )) {
													$parents = buildArr ( $parents, 'parent', 0 );
													echo "<option value='0'>&nbsp;&nbsp;&nbsp;&nbsp;Danh mục gốc</option>";
												} else {
													echo "<option value='0'>" . pzk_or ( @$data->getSelectLabel(), '--Chọn danh mục--' ) . " </option>";
												}
												?>
			<?php foreach($parents as $parent): ?>
			<option value="<?php echo $parent[$data->getShow_value()]; ?>">
				<?php if(isset($parent['parent'])){ echo str_repeat('--', $parent['level']); } ?>
				#<?php echo @$parent['id']?><?php echo $parent[$data->getShow_name()]; ?>
			</option> <?php endforeach; ?>

		</select>
		<script type="text/javascript">
			$('#<?php  echo $data->getIndex()?><?php echo $rand ?>').val('<?php  echo $data->getValue()?>');
        </script>
	</div>
</div>