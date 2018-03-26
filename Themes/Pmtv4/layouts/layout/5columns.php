<?php $items = $data->getItems(); 
$items = buildTree($items);
$root = $items[0]; ?>

<div class="container top-25 bottom-25">
	<div class="row">
		<div class="col-xs-12">			
			<div class="header {data.get('bgcolor')}-bold">
				<h2 class="text-center margin-0 padding-10 font-large"><a class="color-white font-large text-bold" href="#">{root[name]}</a></h2>
			</div>
			<div class="row top-10" id="carousel-{data.id}">
				{? $children = $root['children']; $index = 0; ?}
				{each $children as $item}
				<div class="col-sm-15 col-xs-6">
					<div class="{data.get('bgcolor')}">
						<h3 class="text-center margin-0 padding-10 auto-font"><a href="/{item[alias]}" class="color-white margin-0 padding-10 auto-font">{item[name]}</a></h3>
						<div class="img-5-columns text-center">
							<img class="img-responsive" src="<?php echo pzk_or($item['img'], '/Themes/pmtv4/skin/media/4column-detail-image.jpg')?>" />
						</div>
						<p class="lesson">
							<span class="intro-text">{item[brief]}</span>
						</p>
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
	size: 5,
	childSelector: 	'.col-sm-15',
	mobile: {size: 2},
	desktop: {size: 5}
});
</script>