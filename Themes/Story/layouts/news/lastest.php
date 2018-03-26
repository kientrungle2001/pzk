{? $items = $data->getItems(); ?}
{each $items as $item}
<div class="row">
	<div class="col-md-12 col-xs-12 bdright">
		<a href="newsdetail.php?id={item[id]}&parentid={item[categoryId]}"><img src="{item[img]}" class="img-responsive imgheight center-block"/></a>
	</div>
	<div class="col-md-12 col-xs-12 text-center">
		<a href="newsdetail.php?id={item[id]}&parentid={item[categoryId]}"><h4>{item[title]}</h4></a>
		<?php $str = $item['brief'];?>
		<p><?php echo cut_words($str, 10); ?></p>
	</div>
</div>
{/each}