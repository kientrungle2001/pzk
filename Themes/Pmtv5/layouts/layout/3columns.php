<?php $items = $data->getItems(); 
$items = buildTree($items);
$root = $items[0]; ?>

<div class="category-section home-<?php echo @$root['alias']?>">
	<div class="row">
		<div class="col-xs-12">			
			<div class="header">
				<h2 class="title"><a href="/<?php echo @$root['alias']?>"><img src="/Themes/pmtv5/skin/media/luyentuvacau.png" style="height: 35px;" /> <?php echo @$root['name']?></a></h2>
			</div>
			<div class="row top-10" id="carousel-<?php echo @$data->id?>">
				<?php  $children = $root['children']; $index = 0; ?>
				<?php foreach($children as $item): ?>
				<div class="col-sm-4 carousel-item">
					<?php  if(!$data->getHiddenTitle()): ?>
					<h3 class="title"><a href="<?php echo @$item['alias']?>"><?php echo @$item['name']?></a></h3>
					<?php  endif; ?>
					<div class="text-center">
						<a href="/<?php echo @$root['alias']?>"><img class="img-responsive" src="<?php echo pzk_or($item['img'], '/Themes/pmtv4/skin/media/4column-detail-image.jpg');?>" /></a>
					</div>
				</div>
				<?php  $index++; ?>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
	
</div>

<script>
$('#carousel-<?php echo @$data->id?>').carousel({
	size: 1,
	childSelector: 	'.col-sm-3',
	desktop: {size: 4}
});
</script>