<?php  
$rand 		= rand(1, 100);
$xssize 	= pzk_or($data->get('xssize'), 12);
$mdsize 		= pzk_or($data->get('mdsize'), 12);
?>
<div class="col-xs-<?php echo $xssize ?> col-md-<?php echo $mdsize ?>">
	<div class="form-group clearfix">
		<label for="<?php  echo $data->get('index')?><?php echo $rand ?>"><?php  echo $data->get('label')?></label>
		<div style="float: left; width: 100%;" class="item">
			<textarea id="<?php  echo $data->get('index')?><?php echo $rand ?>" class="tinymce"
				name="<?php  echo $data->get('index')?>"><?php  echo $data->get('value')?></textarea>
		</div>
	</div>
</div>
