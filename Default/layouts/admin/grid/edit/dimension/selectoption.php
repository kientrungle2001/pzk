<?php
$rand = $data->getRand();
$i = $data->getColIndex();
?>
<select class="form-control"
				name="{? echo $data->get('index')?}_flat[col{i}][]"  placeholder="{? echo $data->get('label')?}">
	<option>Tất cả</option> {each $data->getOption() as $key=>$val}
	<option value="{key}">{val}</option> {/each}
</select>