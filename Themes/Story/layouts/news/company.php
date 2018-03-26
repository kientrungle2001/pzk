{? $items = $data->getItems(); ?}
{each $items as $item}
<div class="row bdbot left20 bot20">
	<div class="col-md-4 col-sm-6 col-xs-12 bot20">
		<img src="{item[img]}" class="whimg img-responsive"/>
	</div>
	<div class="col-md-8 col-sm-6 col-xs-12 ">
		<h4><a href="newsdetail?id={item[id]}&parentid={item[categoryId]}">{item[title]}</a></h4>
		<?php $str = $item['brief'];?>
		<p><?php echo cut_words($str, 25); ?></p>
	</div>
</div>
{/each}