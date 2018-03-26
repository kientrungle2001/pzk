<?php $items = $data->getItems(); 
$items = buildTree($items);
$root = $items[0]; ?>

<div class="category-section home-{root[alias]}">
	<div class="row">
		<div class="col-xs-12">			
			<div class="header">
				<h2 class="title"><a href="#"><img src="/Themes/pmtv5/skin/media/luyentuvacau.png" style="height: 35px;" /> {root[name]}</a></h2>
			</div>
			<div class="row top-10" id="carousel-{data.id}">
				{? $children = $root['children']; $index = 0; ?}
				{each $children as $item}
				<div class="col-sm-3 col-xs-6 carousel-item">
					<div class="relative radius-5" style="border: 2px solid yellow; background:#fff;">
						
						<div class="img-4-columns text-center">
							<img class="img-responsive" src="<?php echo pzk_or($item['img'], '/Themes/pmtv4/skin/media/4column-detail-image.jpg')?>" />
						</div>
						<h3 class="text-center margin-0 padding-10 auto-font"><a href="/{item[alias]}" class="margin-0 padding-10 auto-font">{item[name]}</a></h3>
						<p class="lesson">
							<span class="intro-text">{item[brief]}</span>
						</p>
						<div class="section-index" style="width: 60px; height: 60px; background: yellow;"><span class="font-smaller text-bold">Chủ điểm</span><br /><span class="font-largest text-bold">0{? echo ($index+1) ?}</span></div>
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
	size: 4,
	childSelector: 	'.col-sm-3',
	mobile: {size: 2},
	desktop: {size: 4}
});
</script>