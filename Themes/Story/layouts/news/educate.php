<?php  $items = $data->getItems(); ?>
<?php foreach($items as $item): ?>
<div class="row bdbot left20">
	<div class="col-md-4 col-xs-4 bot20">
		<img src="<?php echo @$item['img']?>" class="img-responsive thumnail center-block whimg"/>
	</div>
	<div class="col-md-8 col-xs-8 ">
		<h4><a href="newsdetail?id=<?php echo @$item['id']?>&parentid=<?php echo @$item['categoryId']?>"><?php echo @$item['title']?></a></h4>
		<?php $str = $item['brief'];?>
		<p><?php echo cut_words($str, 25); ?></p>
	</div>
</div>
<?php endforeach; ?>