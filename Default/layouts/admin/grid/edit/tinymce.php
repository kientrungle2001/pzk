<?php  
$rand 		= rand(1, 100);
$xssize 	= pzk_or($data->getXssize(), 12);
$mdsize 		= pzk_or($data->getMdsize(), 12);
?>
<div class="col-xs-<?php echo $xssize ?> col-md-<?php echo $mdsize ?>">
	<div class="form-group clearfix">
		<label for="<?php  echo $data->getIndex()?><?php echo $rand ?>"><?php  echo $data->getLabel()?></label>
		<div style="float: left; width: 100%;" class="item">
			<textarea id="<?php  echo $data->getIndex()?><?php echo $rand ?>" class="tinymce"
				name="<?php  echo $data->getIndex()?>"><?php  echo $data->getValue()?></textarea>
		</div>
	</div>
</div>
