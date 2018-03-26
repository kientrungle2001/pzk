<?php 
	$language = pzk_global()->get('language');
	$lang = pzk_session('language');
?>
<h3><?php echo $language['same'];?></h3>
<ul class="list-unstyled">
	<?php  $items = $data->getOther(pzk_request('id')); ?>
	{each $items as $item}
	<?php  $cates = $data->getCate($item['categoryId']); ?>
	{each $cates as $cate}
	<li><a href="/document/class-5/subject-{cate[alias]}/{item[alias]}-{item[id]}">{item[title]}</a></li>
	{/each}
	{/each}
</ul>