<?php  
$rand 		= rand(1, 100);
$xssize 	= pzk_or($data->getXssize(), 12);
$mdsize 		= pzk_or($data->getMdsize(), 12);
$inline 		= pzk_or($data->getInline(), false);
?>
<?php if($inline):?>
<div class="col-xs-<?php echo $xssize ?> col-md-<?php echo $mdsize ?>">
	<div class="row">
		<label class="control-label col-md-3" for="<?php  echo $data->getIndex()?><?php echo $rand ?>"><?php  echo $data->getLabel()?></label> 
		<div class="col-md-9">
		<select
			class="form-control" id="<?php  echo $data->getIndex()?><?php echo $rand ?>"
			name="<?php  echo $data->getIndex()?>">
			<option value="0">Chưa kích hoạt</option>
			<option value="1">Đã kích hoạt</option>
		</select>
		</div>
	</div>
</div>
<script>
	$('#<?php  echo $data->getIndex()?><?php echo $rand ?>').val('<?php  echo $data->getValue()?>');
	</script>
<?php else: ?>
	<div class="col-xs-<?php echo $xssize ?> col-md-<?php echo $mdsize ?>">
	<div class="form-group clearfix">
		<label for="<?php  echo $data->getIndex()?><?php echo $rand ?>"><?php  echo $data->getLabel()?></label> <select
			class="form-control" id="<?php  echo $data->getIndex()?><?php echo $rand ?>"
			name="<?php  echo $data->getIndex()?>">
			<option value="0">Chưa kích hoạt</option>
			<option value="1">Đã kích hoạt</option>
		</select>
	</div>
</div>
<script>
	$('#<?php  echo $data->getIndex()?><?php echo $rand ?>').val('<?php  echo $data->getValue()?>');
</script>
<?php endif;?>