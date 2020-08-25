<?php  $fields = $data->getFields();
$item = $data->getRow();
?>
<?php foreach($fields as $field): ?>
<?php  
	$fieldObj = pzk_obj('Core.Db.Grid.Field.' . ucfirst($field['type'])); 
	foreach($field as $key => $val) {
		$fieldObj->set($key, $val);
	}
	$fieldObj->setItemId($item['id']);
	if($fieldObj->getType() == 'parent') {
		$fieldObj->setLevel($item['level']);
	}
	if($fieldObj->getType() == 'ordering') {
		$isOrderingField = true;
		$fieldObj->setLevel(@$item['level']);
	}
	$fieldObj->setRow($item);
	$fieldObj->setValue(@$item[$field['index']]);
?>
<?php  if($data->getShowLabel()): ?><strong><?php  echo $fieldObj->getLabel()?></strong><br /><?php  endif; ?>
	<?php  $fieldObj->display(); ?><?php  echo $data->getDelimiter() ?>
<?php endforeach; ?>