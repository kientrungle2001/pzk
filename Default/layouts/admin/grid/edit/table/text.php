<?php
$rand = $data->getRand();
$fieldIndex = $data->getFieldIndex();
$index		= $data->getIndex();
?>
<input onchange="table_change_<?php echo $fieldIndex ?>_<?php echo $rand ?>()" class="form-control" name="<?php echo $fieldIndex ?>_flat[<?php echo $index ?>][]" placeholder="<?php  echo $data->getLabel()?>" />