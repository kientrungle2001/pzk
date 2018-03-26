<?php
$item = $data->getItem();
$categories = $data->getCategories();
$categoryTag = $data->get('categoryTag');
$newsTag = $data->get('newsTag');
$delimiter = $data->get('delimiter');
?>
<div class="row">
{each $categories as $cat}
	<a href="/{cat.get('alias')}"><{categoryTag} class="breadcrumbs">{cat.get('name')}</{categoryTag}></a> {delimiter}
{/each}
	<a href="/{item[alias]}"><{newsTag} class="breadcrumbs">{item[title]}</{newsTag}></a>
</div>