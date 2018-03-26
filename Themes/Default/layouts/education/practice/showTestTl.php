{? $items = $data->getItems(); ?}
{each $items as $item}
<div class="<?php if($item['trial'] == 1){ echo "col-xs-12"; } else { echo "col-md-2 col-xs-4 widthfix"; } ?> text-center text-uppercase btn-custom3 pd-10 weight-16  testnumber">
	<a href="/test/testtl/{item[id]}" class="text-color">{item[name]}</a>
</div>
{/each}