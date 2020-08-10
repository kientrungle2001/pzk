<?php if($data->get('target') == 'dialog'): ?>
	<a href="<?php  echo $data->get('link') ?><?php  echo $data->get('itemId') ?>" onclick="pzk_list.dialog(<?php  echo $data->get('itemId') ?>, '<?php eval('?>'.PzkParser::parseTemplate($data->get('link'), $data) . '<?php '); ?>'); return false;"><?php  echo $data->get('label')?></a>
<?php else:?>
	<a href="<?php  echo $data->get('link')?><?php  echo $data->get('itemId') ?>" <?php if($data->get('onclick')):?>onclick="<?php eval('?>'.PzkParser::parseTemplate($data->get('onclick'), $data) . '<?php '); ?>; return false;"<?php endif;?>><?php  echo $data->get('label') ?></a>
<?php endif; ?>