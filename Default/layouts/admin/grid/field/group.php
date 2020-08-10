<?php  $fields = $data->get('fields');
$item = $data->get('row');
?>
<?php foreach($fields as $field): ?>
<?php  
	$fieldObj = pzk_obj('Core.Db.Grid.Field.' . ucfirst($field['type'])); 
	foreach($field as $key => $val) {
		$fieldObj->set($key, $val);
	}
	$fieldObj->set('itemId', $item['id']);
	if($fieldObj->get('type') == 'parent') {
		$fieldObj->set('level', $item['level']);
	}
	if($fieldObj->get('type') == 'ordering') {
		$isOrderingField = true;
		$fieldObj->set('level', @$item['level']);
	}
	$fieldObj->set('row', $item);
	$fieldObj->set('value', @$item[$field['index']]);
?>
<?php  if($data->get('showLabel')): ?><strong><?php  echo $fieldObj->get('label')?></strong><br /><?php  endif; ?>
	<?php  $fieldObj->display(); ?><?php  echo $data->get('delimiter') ?>
<?php endforeach; ?>