<?php
$rand = $data->getRand();
$i = $data->getColIndex();
?>
<textarea onchange="dimension_change_{? echo $data->get('index')?}_{rand}()" class="form-control" name="{? echo $data->get('index')?}_flat[col{i}][]"  placeholder="{? echo $data->get('label')?}">
</textarea>