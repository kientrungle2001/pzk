{? if($data->get('switchType') == 'bootstrap') : ?}
<input id="switch-{? echo $data->get('index') ?}-{? echo $data->get('itemId') ?}" type="checkbox" {if $data->get('value')}checked="checked"{/if} data-size="mini" /><script type="text/javascript">jQuery('#switch-{? echo $data->get('index') ?}-{? echo $data->get('itemId') ?}').bootstrapSwitch({onSwitchChange: function(evt,state) { {event changeStatus}({id: {? echo $data->get('itemId') ?}, status: state}); }})</script>
{else}
	{? if($data->get('value') == '1') : ?}
		<span class="glyphicon glyphicon-{? echo pzk_or(@$data->get('icon'), 'star'); ?}" style="color: blue; font-size: 120%; cursor: pointer;" onclick="pzk_list.changeStatus('{? echo $data->get('index') ?}', {? echo $data->get('itemId') ?}, this);" title="{data.get('label')}" data-toggle="tooltip" data-title="{data.get('label')}"></span>
	{else}
		<span class="glyphicon glyphicon-{? echo pzk_or(@$data->get('icon'), 'star'); ?}" style="color: black; font-size: 100%; cursor: pointer;" onclick="pzk_list.changeStatus('{? echo $data->get('index') ?}', {? echo $data->get('itemId') ?}, this);" title="{data.get('label')}" data-toggle="tooltip" data-title="{data.get('label')}"></span>
	{/if}
{/if}
