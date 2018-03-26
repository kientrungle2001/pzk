<?php $items = $data->getItems(); 
	$items = @buildTree($items);


$root = $items[0]; 
if($data->get('parentId') == 172) {
	$children = $root['children'][0]['children'];	
} else {
	$children = $root['children'];
}

?>
<div class="container top-25 bottom-25">
	<div class="row">
		<div class="col-xs-12">
			<div class="header {data.get('bgcolor')}-bold">
				<h2 class="text-center margin-0 padding-10 font-large"><a class="color-white font-large text-bold" href="/{root[alias]}">{root[name]}</a></h2>
			</div>
			<div class="row" id="carousel-{data.id}">
				{? foreach($children as $index => $item) :?}
				<div class="col-sm-15 col-xs-6 top-10">
					<h3 class="{data.get('bgcolor')} text-center margin-0 padding-10 auto-font"><a class="color-white auto-font text-bold" style="display: inline-block; width: 100%; height: 15px; overflow: hidden;" href="/{item[alias]}">{item[name]}</a></h3>
				</div>
				{? endforeach;?}
			</div>
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