<?php  $rules = $data->getRules();
	$state = $data->getState();
	$role = pzk_session()->get('adminLevel');
	$controller = pzk_controller();
?>
<select id="<?php  echo $data->get('index') ?>-<?php  echo $data->get('itemId') ?>" name="workflow[<?php  echo $data->get('index') ?>][<?php  echo $data->get('itemId') ?>]"
onchange="pzk_list.workflow('<?php  echo $data->get('index') ?>', <?php  echo $data->get('itemId') ?>, this.value, this);"
>
	<option value="<?php  echo $data->get('value') ?>"><?php echo $state ?></option>
	<?php foreach($rules as $index => $settings): ?>
		<?php  
		$roles = explodetrim(',', @$settings['adminLevel']);
		if ($role == 'Administrator' || in_array($role, $roles)) { ?>
		<option value="<?php echo $index ?>"> -&gt; <?php echo @$settings['action']?></option>
		<?php  } ?>
	<?php endforeach; ?>
</select>