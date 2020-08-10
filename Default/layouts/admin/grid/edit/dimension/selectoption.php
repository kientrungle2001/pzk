<?php
$rand = $data->getRand();
$i = $data->getColIndex();
?>
<select class="form-control"
				name="<?php  echo $data->get('index')?>_flat[col<?php echo $i ?>][]"  placeholder="<?php  echo $data->get('label')?>">
	<option>Tất cả</option> <?php foreach($data->getOption() as $key=>$val): ?>
	<option value="<?php echo $key ?>"><?php echo $val ?></option> <?php endforeach; ?>
</select>