<?php 
$items 				= 	$data->getItems(); 
$items 				= 	buildTree($items);
$root 				= 	$items[0];
$children 			= 	$root['children'];
$cautaotu			=	$children[0];
foreach($children as $child) {
	if($child['id'] == $data->get('menuId')) {
		$cautaotu	=	$child;
		break;
	}
}
$basic				= 	$cautaotu['children'][0];
$advance			= 	$cautaotu['children'][1];
$basicChildren		=	$basic['children'];
$advanceChildren	=	$advance['children'];
?>
<div class="lecture-region {cautaotu[alias]}">
	<div class="lecture-bird hidden-xs"></div>
	<div class="container">
		<h1 class="text-center color7">Luyện từ và câu</h1>
		<div class="row columns-lecture">
			
			<div class="col-md-10 col-xs-12">
				
				<div class="lecture-index">
					<h2 class="bgcolor10-bold color7 hidden-xs">{cautaotu[name]}</h2>
					<div class="lecture-left">
						<h3 class="lecture-section-heading color7"><span class="glyphicon glyphicon-pencil"></span> {basic[name]}</h3>
						{? 	$index = 1; ?}
						{each $basicChildren as $item}
						<div class="lecture-item num{index}">
							<div class="lecture-title color7"><a href="/{item[alias]}">{item[name]}</a></div>
							<div class="lecture-detail"><a href="/{item[alias]}">Bài giảng</a></div>
							<div class="lecture-practice"><a href="/{item[alias]}">Bài tập</a></div>
						</div>
						{?	$index++; ?}
						{/each}
					</div>
					<div class="lecture-right">
						<h3 class="lecture-section-heading color7"><span class="glyphicon glyphicon-pencil"></span> {advance[name]}</h3>
						{? 	$index = 1; ?}
						{each $advanceChildren as $item}
						<div class="lecture-item num{index}">
							<div class="lecture-title color7"><a href="/{item[alias]}">{item[name]}</a></div>
							<div class="lecture-detail"><a href="/{item[alias]}">Bài giảng</a></div>
							<div class="lecture-practice"><a href="/{item[alias]}">Bài tập</a></div>
						</div>
						{?	$index++; ?}
						{/each}
					</div>
					<div class="lecture-girl-cartoon hidden-xs"></div>
					<div class="clear"></div>
				</div>
			</div>
			<div class="col-md-2 col-xs-12">
				<div class="lecture-menu">
				
				<ul>
					{each $children as $item}
					<li><a href="/{item[alias]}">{item[name]}</a></li>
					{/each}
				</ul>
				</div>
			</div>
		</div>
	</div>
</div>