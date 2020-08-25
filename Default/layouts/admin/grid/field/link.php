<?php if($data->getTarget() == 'dialog'): ?>
	<a href="<?php  echo $data->getLink() ?><?php  echo $data->getItemId() ?>" onclick="pzk_list.dialog(<?php  echo $data->getItemId() ?>, '<?php eval('?>'.PzkParser::parseTemplate($data->getLink(), $data) . '<?php '); ?>'); return false;"><?php  echo $data->getLabel()?></a>
<?php else:?>
	<a href="<?php  echo $data->getLink()?><?php  echo $data->getItemId() ?>" <?php if($data->getOnclick()):?>onclick="<?php eval('?>'.PzkParser::parseTemplate($data->getOnclick(), $data) . '<?php '); ?>; return false;"<?php endif;?>><?php  echo $data->getLabel() ?></a>
<?php endif; ?>