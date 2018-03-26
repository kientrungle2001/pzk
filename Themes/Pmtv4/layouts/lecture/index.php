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
		<h1 class="text-center">Luyện từ và câu</h1>
		<div class="row columns-lecture">
			<div class="col-lg-12 col-md-6 hidden-sm hidden-xs">&nbsp;</div>
			<div class="col-lg-2 col-md-6">
				<div class="lecture-menu">
				
				<ul class="row">
					{each $children as $item}
					<li class="col-lg-12 col-md-6"><a href="/{item[alias]}">{item[name]}</a></li>
					{/each}
				</ul>
				</div>
			</div>
			<div class="col-lg-10 col-md-12 col-sm-12">
				
				<div class="lecture-index">
					<div class="lecture-left">
						<h3 class="lecture-section-heading lecture-basic bgcolor1">{basic[name]}</h3>
						{? 	$index = 1; ?}
						{each $basicChildren as $item}
						<div class="lecture-item blcolor1-bold num{index}">
							<div class="lecture-title color1-bold"><a href="/{item[alias]}">{item[name]}</a></div>
							<?php for($i = 0; $i < 9; $i++):
							$j = $i;
							if($i == 0) {
								$j = '';
							}
							if(!isset($item['video' . $j]) || !$item['video' . $j]) continue;
							?>
							<div class="lecture-detail">
							<a href="/{item[alias]}?video={j}"><?php echo $item['video' . $j . '_title']?></a>
							</div>
							<?php endfor;?>
							<div class="lecture-practice"><a href="/{item[alias]}">Bài tập</a></div>
						</div>
						{?	$index++; ?}
						{/each}
					</div>
					<div class="lecture-right">
						<h3 class="lecture-section-heading lecture-advance bgcolor1">{advance[name]}</h3>
						{? 	$index = 1; ?}
						{each $advanceChildren as $item}
						<div class="lecture-item blcolor1-bold num{index}">
							<div class="lecture-title color1-bold"><a href="/{item[alias]}">{item[name]}</a></div>
							<?php for($i = 0; $i < 9; $i++):
							$j = $i;
							if($i == 0) {
								$j = '';
							}
							if(!isset($item['video' . $j]) || !$item['video' . $j]) continue;
							?>
							<div class="lecture-detail">
							<a href="/{item[alias]}?video={j}"><?php echo $item['video' . $j . '_title']?></a>
							</div>
							<?php endfor;?>
							<div class="lecture-practice"><a href="/{item[alias]}">Bài tập</a></div>
						</div>
						{?	$index++; ?}
						{/each}
					</div>
					<div class="clear"></div>
				</div>
			</div>
		</div>
	</div>
</div>