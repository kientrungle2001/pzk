<?php
$rand = $data->get('rand');
$i = $data->get('colIndex');
$fieldIndex = $data->get('fieldIndex');
$index		= $data->get('index');
?>
<select onchange="table_change_{fieldIndex}_{rand}()" class="form-control"
				name="{fieldIndex}_flat[{index}][]" placeholder="{? echo $data->get('label')?}">
	<option value="">Tất cả</option> {each $data->get('option') as $key=>$val}
	<option value="{key}">{val}</option> {/each}
</select>