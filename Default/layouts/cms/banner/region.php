<?php
$items = $data->getItems();
foreach($items as $item) :
	$banner = pzk_obj_once('Cms.Banner.Banner');
	$banner->setItemId($item['id']);
	$banner->display();
endforeach;