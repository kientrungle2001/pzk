{? $items = $data->getItems(); ?}
{each $items as $item}
<div class="col-md-2 text-center col-xs-2 text-uppercase btn-custom3 pd-10 weight-16 widthfix practicenumber<?php if($item['isNew']): echo ' isNew'; endif;?>">
	<a  href="/practice-examination/class-5/examination-{item[id]}" class="text-color">{item[name]}</a>
</div>
{/each}
<div class="col-md-2 text-center col-xs-2 text-uppercase btn-custom3 pd-10 weight-16 widthfix other">
	<a href="/practice-examination/class-5" class="text-color">...</a>
</div>