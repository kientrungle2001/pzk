<?php
$item = $data->getItem();
$positions = $data->getPositions();
?>
<h1>Controller: <?php echo @$item['controller_name']?>/<?php echo @$item['action_name']?></h1>
<div class="row">
<div class="col-xs-12">
<?php
foreach($positions as $pos) {
	$pos->display();
}
?>
</div>
</div>