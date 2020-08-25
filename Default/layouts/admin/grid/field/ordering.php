<?php
$tab = '|&nbsp;&nbsp;&nbsp;&nbsp;';

$content = rtrim(str_repeat($tab, $data->getLevel()), '&nbsp;').'__';
?>
<?php echo $content ?>
<input id="<?php  echo $data->getIndex() ?>_<?php  echo $data->getItemId() ?>" type="text" name="<?php  echo $data->getIndex() ?>[<?php  echo $data->getItemId() ?>]" value="<?php  echo $data->getValue() ?>" rel="<?php  echo $data->getItemId() ?>" style="width: 20px;" />