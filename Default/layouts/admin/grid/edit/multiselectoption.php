<?php  
$rand 		= rand(1, 100);
$xssize 	= pzk_or($data->get('xssize'), 12);
$mdsize 		= pzk_or($data->get('mdsize'), 12);
?>
<div class="col-xs-<?php echo $xssize ?> col-md-<?php echo $mdsize ?>">
	<div class="form-group clearfix">
		<label for="<?php  echo $data->get('index')?><?php echo $rand ?>"><?php  echo $data->get('label')?></label> <select
			multiple="multiple" class="select2-container form-control select2"
			id="<?php  echo $data->get('index')?><?php echo $rand ?>" name="<?php  echo $data->get('index')?>[]" size="10">
        <?php
								$options = $data->get('option');
								
								?>
        <?php foreach($options as $key => $option): ?>
        <?php
								$selected = '';
								$trimIds = trim ( $data->get('value'), ',' );
								$arrIds = explode ( ',', $trimIds );
								if (in_array ( $key, $arrIds )) {
									$selected = 'selected="selected"';
								}
								?>
        <option <?php echo $selected; ?> value="<?php echo $key; ?>">
            <?php echo $option; ?>
        </option> <?php endforeach; ?>

		</select>
		<script type="text/javascript">
		$('#<?php  echo $data->get('index')?><?php echo $rand ?>').select2( { placeholder: "<?php  echo $data->get('label')?>", allowClear: true } );
		</script>
	</div>
</div>