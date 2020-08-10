<?php  
$rand 		= rand(1, 100);
$xssize 	= pzk_or($data->get('xssize'), 12);
$mdsize 		= pzk_or($data->get('mdsize'), 12);
?>
<div class="col-xs-<?php echo $xssize ?> col-md-<?php echo $mdsize ?>">
	<div class="form-group clearfix">
		<label for="<?php  echo $data->get('index')?><?php echo $rand ?>"><?php  echo $data->get('label')?></label>
		<div class="item">
			<select class="select2-container form-control select2" id="<?php  echo $data->get('index')?><?php echo $rand ?>"
				name="<?php  echo $data->get('index')?>">
				<option>Tất cả</option> <?php foreach($data->get('option') as $key=>$val): ?>
				<option value="<?php echo $key ?>"><?php echo $val ?></option> <?php endforeach; ?>
			</select>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('#<?php  echo $data->get('index')?><?php echo $rand ?>').val('<?php  echo $data->get('value')?>');
	$( "#<?php  echo $data->get('index')?><?php echo $rand ?>" ).select2( { placeholder: "<?php  echo $data->get('label')?>", maximumSelectionSize: 6 } );
</script>