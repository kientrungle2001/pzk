<?php
$item = $data->getItem();
$categories = $data->getCategories();
$categoryTag = $data->get('categoryTag');
$newsTag = $data->get('newsTag');
$delimiter = $data->get('delimiter');
$first = true;
?>
<div class="container">
	<ol class = "breadcrumb top20">
		<li><a href = "/home/news">Tin tức</a></li>
	   {each $categories as $cat}
	   {? if($first) { $first = false; continue; }?}
	   <li>{cat.get('name')}</li>
	   {/each}
	   <li class="active">{item[title]}</li>
	</ol>
</div>