<?php  if($data->get('switchType') == 'bootstrap') : ?>
<input id="switch-<?php  echo $data->get('index') ?>-<?php  echo $data->get('itemId') ?>" type="checkbox" <?php if($data->get('value')): ?>checked="checked"<?php endif; ?> data-size="mini" /><script type="text/javascript">jQuery('#switch-<?php  echo $data->get('index') ?>-<?php  echo $data->get('itemId') ?>').bootstrapSwitch({onSwitchChange: function(evt,state) { {event changeStatus}({id: <?php  echo $data->get('itemId') ?>, status: state}); }})</script>
<?php else: ?>
	<?php  if($data->get('value') == '1') : ?>
		<span class="glyphicon glyphicon-<?php  echo pzk_or(@$data->get('icon'), 'star'); ?>" style="color: blue; font-size: 120%; cursor: pointer;" onclick="pzk_list.changeStatus('<?php  echo $data->get('index') ?>', <?php  echo $data->get('itemId') ?>, this);" title="<?php echo $data->get('label')?>" data-toggle="tooltip" data-title="<?php echo $data->get('label')?>"></span>
	<?php else: ?>
		<span class="glyphicon glyphicon-<?php  echo pzk_or(@$data->get('icon'), 'star'); ?>" style="color: black; font-size: 100%; cursor: pointer;" onclick="pzk_list.changeStatus('<?php  echo $data->get('index') ?>', <?php  echo $data->get('itemId') ?>, this);" title="<?php echo $data->get('label')?>" data-toggle="tooltip" data-title="<?php echo $data->get('label')?>"></span>
	<?php endif; ?>
<?php endif; ?>
