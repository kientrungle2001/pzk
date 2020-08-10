<!--pzk_notifier_messages-->
<?php $messages = pzk_notifier_messages();
	if($messages){
	?>
<div id="notifier_user" style='margin-top: 30px;' class="container">
	
	<?php foreach($messages as $item): ?>
		<div class="alert alert-<?php echo @$item['type']?>"><?php echo @$item['message']?></div>
	<?php endforeach; ?>
	
</div>
	<?php } ?>
	
<script>
	$('nav.navbar.nav.container').after($('#notifier_user'));
</script>