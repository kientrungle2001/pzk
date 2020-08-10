<?php  $items = $data->getItems(); ?>
<?php foreach($items as $item): ?>
<div class="row">
	<div class="col-md-12 col-xs-12 bdright">
		<a href="newsdetail.php?id=<?php echo @$item['id']?>&parentid=<?php echo @$item['categoryId']?>"><img src="<?php echo @$item['img']?>" class="img-responsive imgheight center-block"/></a>
	</div>
	<div class="col-md-12 col-xs-12 text-center">
		<a href="newsdetail.php?id=<?php echo @$item['id']?>&parentid=<?php echo @$item['categoryId']?>"><h4><?php echo @$item['title']?></h4></a>
		<?php $str = $item['brief'];?>
		<p><?php echo cut_words($str, 10); ?></p>
	</div>
</div>
<?php endforeach; ?>