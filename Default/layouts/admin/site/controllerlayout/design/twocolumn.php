<?php
$item = $data->getItem();
$positions = $data->getPositions();
?>
<h1>Controller: <?php echo @$item['controller_name']?>/<?php echo @$item['action_name']?></h1>
<div class="row">
	<div class="col-xs-3">
	<?php
		$positions['left']->display();
	?>
	</div>
	<div class="col-xs-9">
	<?php
		$positions['right']->display();
	?>
	</div>
</div>