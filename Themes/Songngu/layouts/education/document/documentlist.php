<?php $items = $data->getItems();?>
<ul class="nav nav-pills nav-stacked">
	{each $items as $item}
	<?php 
	$active = ($data->getSelectedItemId() == $item['id']) ? 'class="active sharp text-center"': 'class="sharp text-center"';
	?>
	<li {active}><a href="/document/detail/{data.getCategoryId()}?class={data.get('class')}&id={item[id]}">{item[title]}</a></li>
	{/each}
</ul>