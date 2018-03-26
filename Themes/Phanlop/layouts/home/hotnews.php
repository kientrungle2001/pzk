{? $item = $data->getFLSN(); ?}
<?php $datacontent = @explode('=====',$item[content]);
 ?>
	<h2 class="text-center">{item[title]}</h2>
	<p class="text-justify">{item[brief]}</p>
	<p class="text-justify"><?=$datacontent[0];?></p>

