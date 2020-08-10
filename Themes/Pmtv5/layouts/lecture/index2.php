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
<div class="lecture-region <?php echo @$cautaotu['alias']?>">
	<div class="lecture-bird hidden-xs"></div>
	<div class="container">
		<h1 class="text-center color7">Luyện từ và câu</h1>
		<div class="row columns-lecture">
			
			<div class="col-md-10 col-xs-12">
				
				<div class="lecture-index">
					<h2 class="bgcolor10-bold color7 hidden-xs"><?php echo @$cautaotu['name']?></h2>
					<div class="lecture-left">
						<h3 class="lecture-section-heading color7"><span class="glyphicon glyphicon-pencil"></span> <?php echo @$basic['name']?></h3>
						<?php  	$index = 1; ?>
						<?php foreach($basicChildren as $item): ?>
						<div class="lecture-item num<?php echo $index ?>">
							<div class="lecture-title color7"><a href="/<?php echo @$item['alias']?>"><?php echo @$item['name']?></a></div>
							<div class="lecture-detail"><a href="/<?php echo @$item['alias']?>">Bài giảng</a></div>
							<div class="lecture-practice"><a href="/<?php echo @$item['alias']?>">Bài tập</a></div>
						</div>
						<?php 	$index++; ?>
						<?php endforeach; ?>
					</div>
					<div class="lecture-right">
						<h3 class="lecture-section-heading color7"><span class="glyphicon glyphicon-pencil"></span> <?php echo @$advance['name']?></h3>
						<?php  	$index = 1; ?>
						<?php foreach($advanceChildren as $item): ?>
						<div class="lecture-item num<?php echo $index ?>">
							<div class="lecture-title color7"><a href="/<?php echo @$item['alias']?>"><?php echo @$item['name']?></a></div>
							<div class="lecture-detail"><a href="/<?php echo @$item['alias']?>">Bài giảng</a></div>
							<div class="lecture-practice"><a href="/<?php echo @$item['alias']?>">Bài tập</a></div>
						</div>
						<?php 	$index++; ?>
						<?php endforeach; ?>
					</div>
					<div class="lecture-girl-cartoon hidden-xs"></div>
					<div class="clear"></div>
				</div>
			</div>
			<div class="col-md-2 col-xs-12">
				<div class="lecture-menu">
				
				<ul>
					<?php foreach($children as $item): ?>
					<li><a href="/<?php echo @$item['alias']?>"><?php echo @$item['name']?></a></li>
					<?php endforeach; ?>
				</ul>
				</div>
			</div>
		</div>
	</div>
</div>