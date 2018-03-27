{? $src = $data->src;
$link = $data->getLink();
?}
<?php if($link): ?><a href="{link}"><?php endif; ?>
<img id="{prop id}" class="{prop class}" src="{prop src}" style="width: {prop width}; height: {prop height}; {prop style}" />
<?php if($link): ?></a><?php endif; ?>