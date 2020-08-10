<?php  
$rand 		= rand(1, 100);
$xssize 	= pzk_or($data->get('xssize'), 12);
$mdsize 		= pzk_or($data->get('mdsize'), 12);
?>

<div class="col-xs-<?php echo $xssize ?> col-md-<?php echo $mdsize ?>">
	<div class="form-group clearfix">
		<label for="<?php  echo $data->get('index')?><?php echo $rand ?>"><?php  echo html_escape($data->get('label'))?></label> <input
			type="<?php echo $data->get('type')?>" class="form-control"
			id="<?php  echo $data->get('index')?><?php echo $rand ?>" name="<?php  echo $data->get('index')?>"
			placeholder="<?php  echo html_escape($data->get('label'))?>"
			value="<?php  if ($data->get('type') != 'password') { 
				if($data->get('type') == 'date') {
					echo date('Y-m-d', strtotime(@$data->get('value')));
				} else {
					echo html_escape(@$data->get('value'));
				}
			} ?>" />
	</div>
</div>