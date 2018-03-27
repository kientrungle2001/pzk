{? $rules = $data->getRules();
	$state = $data->getState();
	$role = pzk_session()->get('adminLevel');
	$controller = pzk_controller();
?}
<select id="{? echo $data->get('index') ?}-{? echo $data->get('itemId') ?}" name="workflow[{? echo $data->get('index') ?}][{? echo $data->get('itemId') ?}]"
onchange="pzk_list.workflow('{? echo $data->get('index') ?}', {? echo $data->get('itemId') ?}, this.value, this);"
>
	<option value="{? echo $data->get('value') ?}">{state}</option>
	{each $rules as $index => $settings}
		{? 
		$roles = explodetrim(',', @$settings['adminLevel']);
		if ($role == 'Administrator' || in_array($role, $roles)) { ?}
		<option value="{index}"> -&gt; {settings[action]}</option>
		{? } ?}
	{/each}
</select>