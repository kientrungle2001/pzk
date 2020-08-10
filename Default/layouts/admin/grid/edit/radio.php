<?php  
$rand 		= rand(1, 100);
$xssize 	= pzk_or($data->get('xssize'), 12);
$mdsize 		= pzk_or($data->get('mdsize'), 12);
?>
<div class="col-xs-<?php echo $xssize ?> col-md-<?php echo $mdsize ?>">
	<div class="form-group clearfix">
		<label for="<?php  echo $data->get('index')?><?php echo $rand ?>"><?php  echo $data->get('label')?></label>
    <?php $options = $data->get('options'); $val = $data->get('value');?>
    <?php foreach($options as $key =>$item): ?>
        <input type="<?php echo $data->get('type')?>"
			<?Php if($key == $val){ echo 'checked'; } ?>
			id="<?php  echo $data->get('index')?><?php echo $rand ?>" name="<?php  echo $data->get('index')?>"
			placeholder="<?php  echo $data->get('label')?>" value="<?php echo $key ?>" /><?php echo $item ?> <?php endforeach; ?>
	</div>
</div>