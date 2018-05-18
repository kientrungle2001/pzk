<?php
$data->addFilter('status', 1);
$items = $data->getItems();
?>
{each $items as $item}
	<?php 
		if($item['xml']) {
			$elem = pzk_parse($item['xml']);
		} else {
			$elem = pzk_parse($item['page']);
		}
		
		$elem->display();
		
		if($item['script']) {
			eval($item['script']);
		}
	?>
{/each}