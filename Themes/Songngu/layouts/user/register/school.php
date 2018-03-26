<?php 
	$districtId= $data->get('districtId');
	$areacode = _db()->getEntity('User.Account.User');
	$areas = $areacode->getAreaByParent($districtId);

 ?>
 <option value="" >Chọn trường</option>
{each $areas as $item}
	<option value="{item[id]}" >{item[name]}</option>
{/each}