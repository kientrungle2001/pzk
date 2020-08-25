<?php // require_once BASE_DIR . '/lib/string.php'; ?>
<?php if(@$data->getIsRaw()):?>
	<?php  echo $data->getValue() ?>
<?php else: ?>
<span class="inline-edit" id="inline-item-<?php  echo $data->getIndex() ?>-<?php  echo $data->getItemId() ?>">
	<span class="inline-text" ondblclick="pzk_list.showInlineEdit('<?php  echo $data->getIndex() ?>', <?php  echo $data->getItemId() ?>); return false;">
		<?php
		$value = $data->getValue();
		if($value == '') $value = '(Trống)';
		if(isset($data->maps)) {
			if(isset($data->maps[$data->value])) {
				$value = $data->maps[$value];
			}
		}
		$value = html_escape($value);
		if(@$data->getLink()): ?>
		<a target="<?php  echo $data->getTarget() ?>" <?php if(@$data->getCtrlLink()): ?>class="ctrl-click" data-ctrlLink="<?php eval('?>'.PzkParser::parseTemplate($data->getCtrlLink(), $data) . '<?php '); ?><?php  echo $data->getItemId() ?>"<?php endif;?> href="<?php eval('?>'.PzkParser::parseTemplate($data->getLink(), $data) . '<?php '); ?><?php  echo $data->getItemId() ?>"><?php echo $value ?></a>
		<?php else:?>
		<?php echo $value ?>
		<?php endif;?>
		<?php if(0):?>
		<!--a class="hidden-input" href="#" onclick="pzk_list.showInlineEdit('<?php  echo $data->getIndex() ?>', <?php  echo $data->getItemId() ?>); return false;"><span class="glyphicon glyphicon-edit"></span></a-->
		<?php endif;?>
	</span>
	<span class="inline-input" style="display: none;">
		<input class="inline-input-field" type="text" name="<?php  echo $data->getIndex() ?>" value="<?php  echo $value ?>" 
			onblur="pzk_list.inlineFocus=false;" 
			onfocus="pzk_list.inlineFocus=true;"
			onkeyup="event = event||window.event; if(event.which==13) {pzk_list.saveInlineEdit('<?php  echo $data->getIndex() ?>', <?php  echo $data->getItemId() ?>); return false;}; "
			/>
		<a href="#" onclick="pzk_list.saveInlineEdit('<?php  echo $data->getIndex() ?>', <?php  echo $data->getItemId() ?>); return false;"><span class="glyphicon glyphicon-save"></span></a>
		<a href="#" onclick="pzk_list.cancelInlineEdit('<?php  echo $data->getIndex() ?>', <?php  echo $data->getItemId() ?>); return false;"><span class="glyphicon glyphicon-remove"></span></a>
	</span>
</span>
<?php endif; ?>