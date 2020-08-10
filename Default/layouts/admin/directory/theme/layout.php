<?php $item = $data->getItem();
$positionObject = $data->getPositionObject();
 ?>
<div class="container">
<h2>Layout: <?php echo @$item['theme']?> / <?php echo @$item['name']?></h2>
<hr />
<h3>Positions</h3>
<?php $positionObject->display(); ?>
<a href="/admin_directory_theme/index">Back To Design</a>
</div>
