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

$basicChildren		=	array($cautaotu['children'][0], $cautaotu['children'][1]);
$advanceChildren	=	array($cautaotu['children'][2], $cautaotu['children'][3], $cautaotu['children'][4]);
$index 				= 	1;
?>
<div class="lecture-region {cautaotu[alias]}">
	<div class="lecture-bird hidden-xs"></div>
	<div class="container">
		<h1 class="text-center">Luyện từ và câu</h1>
		<div class="row columns-lecture">
			<div class="col-md-12 col-sm-8 hidden-xs">&nbsp;</div>
			<div class="col-md-2 col-sm-4">
				<div class="lecture-menu">
				
				<ul>
					{each $children as $item}
					<li><a href="/{item[alias]}">{item[name]}</a></li>
					{/each}
				</ul>
				</div>
			</div>
			<div class="col-md-10 col-sm-12 col-xs-12">
				
				<div class="lecture-index">
					<h2 class="bgcolor1-bold hidden-xs">{cautaotu[name]}</h2>
					<div class="lecture-left">
						{each $basicChildren as $item}
						<div class="lecture-item blcolor1-bold num{index}">
							<div class="lecture-title color1-bold"><a href="/{item[alias]}">{item[name]}</a></div>
							<div class="lecture-detail"><a href="/{item[alias]}">Bài giảng</a></div>
							<div class="lecture-practice"><a href="/{item[alias]}">Bài tập</a></div>
							{? $index++; ?}
						</div>
						{/each}
					</div>
					<div class="lecture-right">
						{each $advanceChildren as $item}
						<div class="lecture-item blcolor1-bold num{index}">
							<div class="lecture-title color1-bold"><a href="/{item[alias]}">{item[name]}</a></div>
							<div class="lecture-detail"><a href="/{item[alias]}">Bài giảng</a></div>
							<div class="lecture-practice"><a href="/{item[alias]}">Bài tập</a></div>
							{? $index++; ?}
						</div>
						{/each}
					</div>
					<div class="lecture-girl-cartoon hidden-xs"></div>
					<div class="clear"></div>
				</div>
			</div>
		</div>
	</div>
</div>