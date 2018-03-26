<?php 
	$districtId= $data->get('districtId');
	$areas = $data->getAreaByParent($districtId);

 ?>
 <option value="all" >Chọn trường</option>
{each $areas as $item}
	<option value="{item[id]}" >{item[name]}</option>
{/each}