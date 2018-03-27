<?php
$rand = $data->get('rand');
$fieldIndex = $data->get('fieldIndex');
$index		= $data->get('index');
?>
<input onchange="table_change_{fieldIndex}_{rand}()" class="form-control" name="{fieldIndex}_flat[{index}][]" placeholder="{? echo $data->get('label')?}" />