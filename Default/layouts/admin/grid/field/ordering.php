<?php
$tab = '|&nbsp;&nbsp;&nbsp;&nbsp;';

$content = rtrim(str_repeat($tab, $data->get('level')), '&nbsp;').'__';
?>
<?php echo $content ?>
<input id="<?php  echo $data->get('index') ?>_<?php  echo $data->get('itemId') ?>" type="text" name="<?php  echo $data->get('index') ?>[<?php  echo $data->get('itemId') ?>]" value="<?php  echo $data->get('value') ?>" rel="<?php  echo $data->get('itemId') ?>" style="width: 20px;" />