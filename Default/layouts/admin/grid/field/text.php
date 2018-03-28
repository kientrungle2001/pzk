<?php // require_once BASE_DIR . '/lib/string.php'; ?>
{ifprop isRaw}
	{? echo $data->get('value') ?}
{else}
<span class="inline-edit" id="inline-item-{? echo $data->get('index') ?}-{? echo $data->get('itemId') ?}">
	<span class="inline-text" ondblclick="pzk_list.showInlineEdit('{? echo $data->get('index') ?}', {? echo $data->get('itemId') ?}); return false;">
		<?php
		$value = $data->get('value');
		if($value == '') $value = '(Trống)';
		if(isset($data->maps)) {
			if(isset($data->maps[$data->value])) {
				$value = $data->maps[$value];
			}
		}
		$value = html_escape($value);
		if(@$data->link): ?>
		<a target="{? echo $data->get('target') ?}" <?php if(@$data->get('ctrlLink')): ?>class="ctrl-click" data-ctrlLink="<?php eval('?>'.PzkParser::parseTemplate($data->get('ctrlLink'), $data) . '<?php '); ?>{? echo $data->get('itemId') ?}"<?php endif;?> href="<?php eval('?>'.PzkParser::parseTemplate($data->get('link'), $data) . '<?php '); ?>{? echo $data->get('itemId') ?}">{value}</a>
		<?php else:?>
		{value}
		<?php endif;?>
		<?php if(0):?>
		<!--a class="hidden-input" href="#" onclick="pzk_list.showInlineEdit('{? echo $data->get('index') ?}', {? echo $data->get('itemId') ?}); return false;"><span class="glyphicon glyphicon-edit"></span></a-->
		<?php endif;?>
	</span>
	<span class="inline-input" style="display: none;">
		<input class="inline-input-field" type="text" name="{? echo $data->get('index') ?}" value="{? echo html_escape($data->get('value')) ?}" 
			onblur="pzk_list.inlineFocus=false;" 
			onfocus="pzk_list.inlineFocus=true;"
			onkeyup="event = event||window.event; if(event.which==13) {pzk_list.saveInlineEdit('{? echo $data->get('index') ?}', {? echo $data->get('itemId') ?}); return false;}; "
			/>
		<a href="#" onclick="pzk_list.saveInlineEdit('{? echo $data->get('index') ?}', {? echo $data->get('itemId') ?}); return false;"><span class="glyphicon glyphicon-save"></span></a>
		<a href="#" onclick="pzk_list.cancelInlineEdit('{? echo $data->get('index') ?}', {? echo $data->get('itemId') ?}); return false;"><span class="glyphicon glyphicon-remove"></span></a>
	</span>
</span>
{/if}