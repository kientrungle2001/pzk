<?php $items = $data->getItems(); 
$items = buildTree($items);
$root = $items[0]; ?>

<div class="category-section home-{root[alias]}">
	<div class="row">
		<div class="col-xs-12">			
			<div class="header">
				<h2 class="title"><a href="/{root[alias]}"><img src="/Themes/pmtv5/skin/media/luyentuvacau.png" style="height: 35px;" /> {root[name]}</a></h2>
			</div>
			<div class="row top-10" id="carousel-{data.id}">
				{? $children = $root['children']; $index = 0; ?}
				{each $children as $item}
				<div class="col-sm-4 carousel-item">
					{? if(!$data->get('hiddenTitle')): ?}
					<h3 class="title"><a href="{item[alias]}">{item[name]}</a></h3>
					{? endif; ?}
					<div class="text-center">
						<a href="/{root[alias]}"><img class="img-responsive" src="<?php echo pzk_or($item['img'], '/Themes/pmtv4/skin/media/4column-detail-image.jpg');?>" /></a>
					</div>
				</div>
				{? $index++; ?}
				{/each}
			</div>
		</div>
	</div>
	
</div>

<script>
$('#carousel-{data.id}').carousel({
	size: 1,
	childSelector: 	'.col-sm-3',
	desktop: {size: 4}
});
</script>