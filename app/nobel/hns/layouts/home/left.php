<div id="<?php echo @$data->id?>">
	<div id="contain-left">
		<?php $messages = pzk_notifier_messages(); ?>
		<?php foreach($messages as $item): ?>
			<h4 class="highlight label-<?php echo @$item['type']?>"><?php echo @$item['message']?></h4>
		<?php endforeach; ?>
		<?php $data->displayChildren('all') ?>
	</div>
</div>