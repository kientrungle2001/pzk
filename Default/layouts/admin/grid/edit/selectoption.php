<?php  
$rand 		= rand(1, 100);
$xssize 	= pzk_or($data->getXssize(), 12);
$mdsize 		= pzk_or($data->getMdsize(), 12);
?>
<div class="col-xs-<?php echo $xssize ?> col-md-<?php echo $mdsize ?>">
	<div class="form-group clearfix">
		<label for="<?php  echo $data->getIndex()?><?php echo $rand ?>"><?php  echo $data->getLabel()?></label>
		<div class="item">
			<select class="select2-container form-control select2" id="<?php  echo $data->getIndex()?><?php echo $rand ?>"
				name="<?php  echo $data->getIndex()?>">
				<option>Tất cả</option> <?php foreach($data->getOption() as $key=>$val): ?>
				<option value="<?php echo $key ?>"><?php echo $val ?></option> <?php endforeach; ?>
			</select>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('#<?php  echo $data->getIndex()?><?php echo $rand ?>').val('<?php  echo $data->getValue()?>');
	$( "#<?php  echo $data->getIndex()?><?php echo $rand ?>" ).select2( { placeholder: "<?php  echo $data->getLabel()?>", maximumSelectionSize: 6 } );
</script>