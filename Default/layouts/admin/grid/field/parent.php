<?php
// require_once BASE_DIR .'/lib/string.php';
$tab = '|&nbsp;&nbsp;&nbsp;&nbsp;';

$data->set('value', rtrim(str_repeat($tab, $data->get('level')), '&nbsp;').'__'.$data->get('value'));
?>
{ifprop isRaw}
	<?php  echo $data->get('value')?>
<?php else: ?>
<span class="inline-edit" id="inline-item-<?php  echo $data->get('index') ?>-<?php  echo $data->get('itemId') ?>">
	<span class="inline-text" ondblclick="pzk_list.showInlineEdit('<?php  echo $data->get('index') ?>', <?php  echo $data->get('itemId') ?>); return false;">
		<?php
		$value = $data->get('value');
		if($value == '') $value = '(Trống)';
		if(isset($data->maps)) {
			if(isset($data->maps[$data->value])) {
				$value = $data->maps[$value];
			}
		}
		if(@$data->link): ?>
		<a target="<?php echo $data->get('target')?>" href="<?php eval('?>'.PzkParser::parseTemplate($data->get('link'), $data) . '<?php '); ?><?php  echo $data->get('itemId') ?>"><?php echo $value ?></a>
		<?php else:?>
		<?php echo $value ?>
		<?php endif;?>
		<?php if(0):?>
		<!--a class="hidden-input" href="#" onclick="pzk_list.showInlineEdit('<?php  echo $data->get('index') ?>', <?php  echo $data->get('itemId') ?>); return false;"><span class="glyphicon glyphicon-edit"></span></a-->
		<?php endif;?>
	</span>
	<span class="inline-input" style="display: none;">
		<input class="inline-input-field" type="text" name="<?php  echo $data->get('index') ?>" value="<?php  echo html_escape($data->get('value')) ?>" 
			onblur="pzk_list.inlineFocus=false;" 
			onfocus="pzk_list.inlineFocus=true;"
			onkeyup="event = event||window.event; if(event.which==13) {pzk_list.saveInlineEdit('<?php  echo $data->get('index') ?>', <?php  echo $data->get('itemId') ?>); return false;}; "
			/>
		<a href="#" onclick="pzk_list.saveInlineEdit('<?php  echo $data->get('index') ?>', <?php  echo $data->get('itemId') ?>); return false;"><span class="glyphicon glyphicon-save"></span></a>
		<a href="#" onclick="pzk_list.cancelInlineEdit('<?php  echo $data->get('index') ?>', <?php  echo $data->get('itemId') ?>); return false;"><span class="glyphicon glyphicon-remove"></span></a>
	</span>
</span>
<?php endif; ?>