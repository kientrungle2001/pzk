<?php
$rand = $data->get('rand');
$i = $data->get('colIndex');
$fieldIndex = $data->get('fieldIndex');
$index		= $data->get('index');
?>
<select onchange="table_change_<?php echo $fieldIndex ?>_<?php echo $rand ?>()" class="form-control"
				name="<?php echo $fieldIndex ?>_flat[<?php echo $index ?>][]" placeholder="<?php  echo $data->get('label')?>">
	<option value="">Tất cả</option> <?php foreach($data->get('option') as $key=>$val): ?>
	<option value="<?php echo $key ?>"><?php echo $val ?></option> <?php endforeach; ?>
</select>