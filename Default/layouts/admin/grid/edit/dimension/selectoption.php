<?php
$rand = $data->getRand();
$i = $data->getColIndex();
?>
<select class="form-control"
				name="<?php  echo $data->getIndex()?>_flat[col<?php echo $i ?>][]"  placeholder="<?php  echo $data->getLabel()?>">
	<option>Tất cả</option> <?php foreach($data->getOption() as $key=>$val): ?>
	<option value="<?php echo $key ?>"><?php echo $val ?></option> <?php endforeach; ?>
</select>