<?php
$rand = $data->get('rand');
$fieldIndex = $data->get('fieldIndex');
$index		= $data->get('index');
?>
<input onchange="table_change_<?php echo $fieldIndex ?>_<?php echo $rand ?>()" class="form-control" name="<?php echo $fieldIndex ?>_flat[<?php echo $index ?>][]" placeholder="<?php  echo $data->get('label')?>" />