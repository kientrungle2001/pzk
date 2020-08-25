<?php  if($data->getSwitchType() == 'bootstrap') : ?>
<input id="switch-<?php  echo $data->getIndex() ?>-<?php  echo $data->getItemId() ?>" type="checkbox" <?php if($data->getValue()): ?>checked="checked"<?php endif; ?> data-size="mini" /><script type="text/javascript">jQuery('#switch-<?php  echo $data->getIndex() ?>-<?php  echo $data->getItemId() ?>').bootstrapSwitch({onSwitchChange: function(evt,state) { {event changeStatus}({id: <?php  echo $data->getItemId() ?>, status: state}); }})</script>
<?php else: ?>
	<?php  if($data->getValue() == '1') : ?>
		<span class="glyphicon glyphicon-<?php  echo pzk_or(@$data->getIcon(), 'star'); ?>" style="color: blue; font-size: 120%; cursor: pointer;" onclick="pzk_list.changeStatus('<?php  echo $data->getIndex() ?>', <?php  echo $data->getItemId() ?>, this);" title="<?php echo $data->getLabel()?>" data-toggle="tooltip" data-title="<?php echo $data->getLabel()?>"></span>
	<?php else: ?>
		<span class="glyphicon glyphicon-<?php  echo pzk_or(@$data->getIcon(), 'star'); ?>" style="color: black; font-size: 100%; cursor: pointer;" onclick="pzk_list.changeStatus('<?php  echo $data->getIndex() ?>', <?php  echo $data->getItemId() ?>, this);" title="<?php echo $data->getLabel()?>" data-toggle="tooltip" data-title="<?php echo $data->getLabel()?>"></span>
	<?php endif; ?>
<?php endif; ?>
