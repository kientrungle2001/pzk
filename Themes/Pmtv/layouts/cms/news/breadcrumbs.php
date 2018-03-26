<?php
$item = $data->getItem();
$categories = $data->getCategories();
$categoryTag = $data->get('categoryTag');
$newsTag = $data->get('newsTag');
$delimiter = $data->get('delimiter');
?>
<div id="breadcrumbs-container" class="container">
	<div class="row">
		<div class="col-xs-12">
		<a href="/"><{categoryTag} class="breadcrumbs">Trang chủ</{categoryTag}></a> {delimiter}
		{each $categories as $cat}
			<a href="/{cat.get('alias')}"><{categoryTag} class="breadcrumbs">{cat.get('name')}</{categoryTag}></a> {delimiter}
		{/each}
			<a href="/{item[alias]}"><{newsTag} class="breadcrumbs">{item[title]}</{newsTag}></a>
		</div>
	</div>
</div>