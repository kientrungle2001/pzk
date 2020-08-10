<?php 
$items = $data->getItems(); ?>
<?php foreach($items as $item): ?>
<?php echo @$item['name']?><br />
<?php endforeach; ?>