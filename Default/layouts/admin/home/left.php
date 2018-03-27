<?php if(pzk_global()->get('admin_right_module')): ?>
<div class="col-md-10">
<?php else: ?>
<div class="col-md-12">
<?php endif; ?>

	<?php $messages = pzk_notifier_messages(); ?>
	{each $messages as $item}
		<h4 class="highlight label-{item[type]}">{item[message]}</h4>
	{/each}
	{children all}
</div>