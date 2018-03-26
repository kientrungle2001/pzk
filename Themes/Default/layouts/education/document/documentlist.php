<?php $items = $data->getItems();?>
<ul class="nav nav-pills nav-stacked">
	{each $items as $item}
	<?php 
	$active = ($data->get('selectedItemId') == $item['id']) ? 'class="active sharp text-center"': 'class="sharp text-center"';
	?>
	<li {active}><a href="/document/detail/{data.get('categoryId')}?class={data.get('class')}&id={item[id]}">{item[title]}</a></li>
	{/each}
</ul>