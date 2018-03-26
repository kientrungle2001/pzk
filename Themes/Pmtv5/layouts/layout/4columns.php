<?php $items = $data->getItems(); 
$items = buildTree($items);
$root = $items[0]; ?>

<div class="container bottom-25">
	<div class="row">
		<div class="col-xs-12">			
			<div class="header bgcolor5-bold">
				<h2 class="text-left margin-0 padding-10 font-large border-bottom"><a href="/{root[alias]}" class="font-large text-bold color7"><img src="/Themes/pmtv5/skin/media/luyentuvacau.png" style="height: 35px;" /> {root[name]}</a></h2>
			</div>
			<div class="row top-10" id="carousel-{data.id}">
				{? $children = $root['children']; $index = 0; ?}
				{each $children as $item}
				<div class="col-sm-3">
					<h3 class="bgcolor5-bold text-center margin-0 padding-10 font-normal"><a href="{item[alias]}" class="color-white font-normal text-bold">{item[name]}</a></h3>
					<div class="img-4-columns bgcolor5">
						<img class="img-responsive" src="<?php echo pzk_or($item['img'], '/Themes/pmtv4/skin/media/4column-detail-image.jpg');?>" />
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