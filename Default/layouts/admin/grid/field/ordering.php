<?php
$tab = '|&nbsp;&nbsp;&nbsp;&nbsp;';

$content = rtrim(str_repeat($tab, $data->get('level')), '&nbsp;').'__';
?>
{content}
<input id="{? echo $data->get('index') ?}_{? echo $data->get('itemId') ?}" type="text" name="{? echo $data->get('index') ?}[{? echo $data->get('itemId') ?}]" value="{? echo $data->get('value') ?}" rel="{? echo $data->get('itemId') ?}" style="width: 20px;" />