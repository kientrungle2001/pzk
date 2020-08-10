<?php $items = $data->getItems();?>
<ul class="nav nav-pills nav-stacked">
	<?php foreach($items as $item): ?>
	<?php 
	$active = ($data->getSelectedItemId() == $item['id']) ? 'class="active sharp text-center"': 'class="sharp text-center"';
	?>
	<li <?php echo $active ?>><a href="/document/detail/{data.getCategoryId()}?class=<?php echo $data->get('class')?>&id=<?php echo @$item['id']?>"><?php echo @$item['title']?></a></li>
	<?php endforeach; ?>
</ul>