<?php $items = $data->getItems(); 
$items = @buildTree($items);
$root = $items[0]; 
if($root['id'] == 308) {
	$children = $root['children'][0]['children'];
} else {
	$children = $root['children'];
}

?>
<div class="category-section home-{root[alias]}">
	<div class="row">
		<div class="col-xs-12">
			<div class="header">
				<h2 class="title"><a href="/{root[alias]}"><img src="/Themes/pmtv5/skin/media/luyentuvacau.png" style="height: 35px;" /> {root[name]}</a></h2>
			</div>
			<?php if($root['id'] == 310): ?>
			<div class="row" id="carousel-{data.id}">
				{? foreach($children as $index => $item) :?}
				<div class="col-sm-6 col-xs-6 top-10">
					<h3 class="text-center color7 text-bold"><a class="auto-font" href="/{item[alias]}">{item[name]}</a></h3>
					<div class="row">
						<?php for($i = 1; $i < 7; $i++): ?>
							<div class="col-sm-4 col-xs-12 top-10 carousel-item">
								<h3 class="{data.get('bgcolor')} {data.get('bdcolor')} title">
									<a class="auto-font" href="/{item[alias]}">Tuần {i}</a>
								</h3>
							</div>
						<?php endfor;?>
					</div>
				</div>
				{? endforeach;?}
			</div>
			<?php else: ?>
			<div class="row" id="carousel-{data.id}">
				{? foreach($children as $index => $item) :?}
				<div class="col-sm-15 col-xs-6 carousel-item top-10">
					<h3 class="{data.get('bgcolor')} {data.get('bdcolor')} title"><a class="auto-font" href="/{item[alias]}">{item[name]}</a></h3>
				</div>
				{? endforeach;?}
			</div>
			<?php endif;?>
		</div>
	</div>
	
</div>

<script>
$('#carousel-{data.id}').carousel({
	size: 4,
	childSelector: 	'.col-sm-15',
	mobile: {size: 4},
	desktop: {size: 10}
});
</script>