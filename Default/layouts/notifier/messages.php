<!--pzk_notifier_messages-->
<?php $messages = pzk_notifier_messages();
	if($messages){
	?>
<div id="notifier_user" style='margin-top: 30px;' class="container">
	
	{each $messages as $item}
		<div class="alert alert-{item[type]}">{item[message]}</div>
	{/each}
	
</div>
	<?php } ?>
	
<script>
	$('nav.navbar.nav.container').after($('#notifier_user'));
</script>