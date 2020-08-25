<?php  
$rand 		= rand(1, 100);
$xssize 	= pzk_or($data->getXssize(), 12);
$mdsize 		= pzk_or($data->getMdsize(), 12);
?>
<div class="col-xs-<?php echo $xssize ?> col-md-<?php echo $mdsize ?>">
	<div class="form-group clearfix">
		<label for="<?php  echo $data->getIndex()?><?php echo $rand ?>"><?php  echo $data->getLabel()?></label>
		<textarea class="form-control" id="<?php  echo $data->getIndex()?><?php echo $rand ?>"
			name="<?php  echo $data->getIndex()?>" placeholder="<?php  echo $data->getLabel()?>" rows="6"><?php  echo html_escape($data->getValue())?></textarea>
	</div>
</div>