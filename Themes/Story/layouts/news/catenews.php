<ul class="list-unstyled">
<?php  $items = $data->getItems(); ?>
<?php foreach($items as $item): ?>
	<a href="newsdetail.php?id=<?php echo @$item['id']?>&parentid=<?php echo @$item['categoryId']?>"><li class="left40"><?php echo @$item['title']?></li></a>
<?php endforeach; ?>
</ul>
