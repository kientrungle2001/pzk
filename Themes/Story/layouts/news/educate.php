{? $items = $data->getItems(); ?}
{each $items as $item}
<div class="row bdbot left20">
	<div class="col-md-4 col-xs-4 bot20">
		<img src="{item[img]}" class="img-responsive thumnail center-block whimg"/>
	</div>
	<div class="col-md-8 col-xs-8 ">
		<h4><a href="newsdetail?id={item[id]}&parentid={item[categoryId]}">{item[title]}</a></h4>
		<?php $str = $item['brief'];?>
		<p><?php echo cut_words($str, 25); ?></p>
	</div>
</div>
{/each}