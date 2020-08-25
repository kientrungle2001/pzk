<?php
$button = '';
if($data->button) {
	$buttons = explode(' ', $data->button);
	foreach($buttons as &$btn) {
		$btn = 'btn-'. $btn;
	}
	$button = 'btn ' . implode(' ', $buttons);
}
?><a href="<?php echo @$data->src?>" title="<?php echo @$data->getTitle()?>" class="<?php echo @$data->class?> <?php echo $button ?>"><?php echo @$data->label?><?php $data->displayChildren('all') ?></a>