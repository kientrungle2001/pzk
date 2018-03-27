<div id="{prop id}">
	<div id="contain-left">
		<?php $messages = pzk_notifier_messages(); ?>
		{each $messages as $item}
			<h4 class="highlight label-{item[type]}">{item[message]}</h4>
		{/each}
		{children all}
	</div>
</div>