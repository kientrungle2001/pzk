<?php  
$rand 		= rand(1, 100);
$xssize 	= pzk_or($data->getXssize(), 12);
$mdsize 		= pzk_or($data->getMdsize(), 12);
?>
<div class="col-xs-<?php echo $xssize ?> col-md-<?php echo $mdsize ?>">
	<div class="form-group clearfix">
		<label for="<?php  echo $data->getIndex()?><?php echo $rand ?>"><?php  echo $data->getLabel()?></label>
    <?php $options = $data->getOptions(); $val = $data->getValue();?>
    <?php foreach($options as $key =>$item): ?>
        <input type="<?php echo $data->getType()?>"
			<?Php if($key == $val){ echo 'checked'; } ?>
			id="<?php  echo $data->getIndex()?><?php echo $rand ?>" name="<?php  echo $data->getIndex()?>"
			placeholder="<?php  echo $data->getLabel()?>" value="<?php echo $key ?>" /><?php echo $item ?> <?php endforeach; ?>
	</div>
</div>