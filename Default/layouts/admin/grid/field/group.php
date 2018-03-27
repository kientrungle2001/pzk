{? $fields = $data->get('fields');
$item = $data->get('row');
?}
{each $fields as $field}
{? 
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
?}
{? if($data->get('showLabel')): ?}<strong>{? echo $fieldObj->get('label')?}</strong><br />{? endif; ?}
	{? $fieldObj->display(); ?}{? echo $data->get('delimiter') ?}
{/each}