<?php if($data->get('target') == 'dialog'): ?>
	<a href="{? echo $data->get('link') ?}{? echo $data->get('itemId') ?}" onclick="pzk_list.dialog({? echo $data->get('itemId') ?}, '<?php eval('?>'.PzkParser::parseTemplate($data->get('link'), $data) . '<?php '); ?>'); return false;">{? echo $data->get('label')?}</a>
<?php else:?>
	<a href="{? echo $data->get('link')?}{? echo $data->get('itemId') ?}" <?php if($data->get('onclick')):?>onclick="<?php eval('?>'.PzkParser::parseTemplate($data->get('onclick'), $data) . '<?php '); ?>; return false;"<?php endif;?>>{? echo $data->get('label') ?}</a>
<?php endif; ?>