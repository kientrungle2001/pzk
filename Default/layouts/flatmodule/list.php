<?php
$data->addFilter('status', 1);
$items = $data->getItems();
?>
<?php foreach($items as $item): ?>
	<?php 
		if($item['xml']) {
			$elem = pzk_parse($item['xml']);
		} else {
			$elem = pzk_parse($item['page']);
		}
		
		if($item['script']) {
			eval($item['script']);
		}
		
		$elem->display();
	?>
<?php endforeach; ?>