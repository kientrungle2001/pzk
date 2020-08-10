<?php if(pzk_global()->get('admin_right_module')): ?>
<div class="col-md-10">
<?php else: ?>
<div class="col-md-12">
<?php endif; ?>

	<?php $messages = pzk_notifier_messages(); ?>
	<?php foreach($messages as $item): ?>
		<h4 class="highlight label-<?php echo @$item['type']?>"><?php echo @$item['message']?></h4>
	<?php endforeach; ?>
	<?php $data->displayChildren('all') ?>
</div>