<?php  
$rand 		= rand(1, 100);
$xssize 	= pzk_or($data->getXssize(), 12);
$mdsize 		= pzk_or($data->getMdsize(), 12);
?>

<div class="col-xs-<?php echo $xssize ?> col-md-<?php echo $mdsize ?>">
	<div class="form-group clearfix">
		<label for="<?php  echo $data->getIndex()?><?php echo $rand ?>"><?php  echo html_escape($data->getLabel())?></label> <input
			type="<?php echo $data->getType()?>" class="form-control"
			id="<?php  echo $data->getIndex()?><?php echo $rand ?>" name="<?php  echo $data->getIndex()?>"
			placeholder="<?php  echo html_escape($data->getLabel())?>"
			value="<?php  if ($data->getType() != 'password') { 
				if($data->getType() == 'date') {
					echo date('Y-m-d', strtotime(@$data->getValue()));
				} else {
					echo html_escape(@$data->getValue());
				}
			} ?>" />
	</div>
</div>