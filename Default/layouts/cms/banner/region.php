<?php
$items = $data->getItems();
foreach($items as $item) :
	$banner = pzk_obj_once('Cms.Banner.Banner');
	$banner->set('itemId', $item['id']);
	$banner->display();
endforeach;