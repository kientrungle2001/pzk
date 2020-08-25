<?php  $rules = $data->getRules();
	$state = $data->getState();
	$role = pzk_session()->getadminLevel();
	$controller = pzk_controller();
?>
<select id="<?php  echo $data->getIndex() ?>-<?php  echo $data->getItemId() ?>" name="workflow[<?php  echo $data->getIndex() ?>][<?php  echo $data->getItemId() ?>]"
onchange="pzk_list.workflow('<?php  echo $data->getIndex() ?>', <?php  echo $data->getItemId() ?>, this.value, this);"
>
	<option value="<?php  echo $data->getValue() ?>"><?php echo $state ?></option>
	<?php foreach($rules as $index => $settings): ?>
		<?php  
		$roles = explodetrim(',', @$settings['adminLevel']);
		if ($role == 'Administrator' || in_array($role, $roles)) { ?>
		<option value="<?php echo $index ?>"> -&gt; <?php echo @$settings['action']?></option>
		<?php  } ?>
	<?php endforeach; ?>
</select>