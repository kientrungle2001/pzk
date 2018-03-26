{? $items = $data->getItems(); ?}
{each $items as $item}
<div class="col-md-2 text-center col-xs-4 text-uppercase btn-custom3 pd-10 weight-16 widthfix testnumber<?php if($item['isNew']): echo ' isNew'; endif;?>">
	<a href="/test/class-5/examination-{item[id]}" class="text-color">{item[name]}</a>
</div>
{/each}
<div class="col-md-2 text-center col-xs-4 text-uppercase btn-custom3 pd-10 weight-16 widthfix other2">
	<a href="/test/class-5" class="text-color">...</a>
</div>