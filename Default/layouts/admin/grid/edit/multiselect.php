<?php  
$rand 		= rand(1, 100);
$xssize 	= pzk_or($data->getXssize(), 12);
$mdsize 		= pzk_or($data->getMdsize(), 12);
?>
<div class="col-xs-<?php echo $xssize ?> col-md-<?php echo $mdsize ?>">
	<div class="form-group clearfix">
		<label for="<?php  echo $data->getIndex()?><?php echo $rand ?>"><?php  echo $data->getLabel()?></label> <select
			 multiple="multiple" class="select2-container js-states form-control select2"
			id="<?php  echo $data->getIndex()?><?php echo $rand ?>" name="<?php  echo $data->getIndex()?>[]" size="10">
        <?php
								$parents = _db ()->select ( pzk_or($data->get ('fields'), '*') )->from ( $data->getTable() )->where ( pzk_or ( @$data->get ('condition'), '1' ) )->result ();
								if (isset ( $parents [0] ['parent'] )) {
									$parents = treefy ( $parents, 'parent', 0 );
									echo "<option value='0'>&nbsp;&nbsp;&nbsp;&nbsp;Danh mục gốc</option>";
								} else {
									echo "<option value='0'>Danh mục gốc</option>";
								}
								?>
        <?php foreach($parents as $parent): ?>
        <?php
								$selected = '';
								$trimIds = trim ( $data->getValue(), ',' );
								$arrIds = explode ( ',', $trimIds );
								if (in_array ( $parent [$data->getShow_value()], $arrIds )) {
									$selected = 'selected="selected"';
								}
								?>
        <option <?php echo $selected; ?>
				value="<?php echo $parent[$data->getShow_value()]; ?>">
            <?php if(isset($parent['parent'])){ echo str_repeat('--', $parent['level']); } ?>
            #<?php echo @$parent['id']?> - <?php echo $parent[$data->getShow_name()]; ?>
        </option> <?php endforeach; ?>

		</select>
		<script type="text/javascript">
		$('#<?php  echo $data->getIndex()?><?php echo $rand ?>').select2( { placeholder: "<?php  echo $data->getLabel()?>", allowClear: true, closeOnSelect: false } );
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