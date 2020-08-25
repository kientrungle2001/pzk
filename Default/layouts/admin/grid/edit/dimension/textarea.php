<?php
$rand = $data->getRand();
$i = $data->getColIndex();
?>
<textarea onchange="dimension_change_<?php  echo $data->getIndex()?>_<?php echo $rand ?>()" class="form-control" name="<?php  echo $data->getIndex()?>_flat[col<?php echo $i ?>][]"  placeholder="<?php  echo $data->getLabel()?>">
</textarea>