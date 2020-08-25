<?php
$rand = $data->getRand();
$i = $data->getColIndex();
$fieldIndex = $data->getFieldIndex();
$index		= $data->getIndex();
?>
<select onchange="table_change_<?php echo $fieldIndex ?>_<?php echo $rand ?>()" class="form-control"
				name="<?php echo $fieldIndex ?>_flat[<?php echo $index ?>][]" placeholder="<?php  echo $data->getLabel()?>">
	<option value="">Tất cả</option> <?php foreach($data->getOption() as $key=>$val): ?>
	<option value="<?php echo $key ?>"><?php echo $val ?></option> <?php endforeach; ?>
</select>