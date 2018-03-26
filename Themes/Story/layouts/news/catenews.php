<ul class="list-unstyled">
{? $items = $data->getItems(); ?}
{each $items as $item}
	<a href="newsdetail.php?id={item[id]}&parentid={item[categoryId]}"><li class="left40">{item[title]}</li></a>
{/each}
</ul>
