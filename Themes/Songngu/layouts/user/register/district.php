<?php 
	$provinceId= $data->get('provinceId');
	
	$areacode = _db()->getEntity('User.Account.User');
	$areas = $areacode->getAreaByParent($provinceId);

 ?>
 <option value="all" >Chọn quận/ huyện</option>
{each $areas as $item}
	<option value="{item[id]}" >{item[name]}</option>
{/each}