<?php
$rand = $data->getRand();
$i = $data->getColIndex();
?>
<textarea onchange="dimension_change_<?php  echo $data->get('index')?>_<?php echo $rand ?>()" class="form-control" name="<?php  echo $data->get('index')?>_flat[col<?php echo $i ?>][]"  placeholder="<?php  echo $data->get('label')?>">
</textarea>