<?php
$item = $data->getItem();
$categories = $data->getCategories();
$categoryTag = $data->get('categoryTag');
$delimiter = $data->get('delimiter');
?>
<div class="container">
	<div class="row">
		<div class="col-xs-12">
		{each $categories as $cat}
			<a href="/{? echo $cat->get('alias') ?}"><{categoryTag} class="breadcrumbs">{? echo $cat->get('name') ?}</{categoryTag}></a> {delimiter}
		{/each}
		</div>
	</div>
</div>