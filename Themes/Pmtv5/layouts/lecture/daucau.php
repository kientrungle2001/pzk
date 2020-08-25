<?php 
$items 				= 	$data->getItems(); 
$items 				= 	buildTree($items);
$root 				= 	$items[0];
$children 			= 	$root['children'];
$cautaotu			=	$children[0];
foreach($children as $child) {
	if($child['id'] == $data->getMenuId()) {
		$cautaotu	=	$child;
		break;
	}
}

$basicChildren		=	array($cautaotu['children'][0], $cautaotu['children'][1]);
$advanceChildren	=	array($cautaotu['children'][2], $cautaotu['children'][3], $cautaotu['children'][4]);
$index 				= 	1;
?>
<div class="lecture-region <?php echo @$cautaotu['alias']?>">
	<div class="lecture-bird hidden-xs"></div>
	<div class="container">
		<h1 class="text-center">Luyện từ và câu</h1>
		<div class="row columns-lecture">
			<div class="col-md-12 col-sm-8 hidden-xs">&nbsp;</div>
			<div class="col-md-2 col-sm-4">
				<div class="lecture-menu">
				
				<ul>
					<?php foreach($children as $item): ?>
					<li><a href="/<?php echo @$item['alias']?>"><?php echo @$item['name']?></a></li>
					<?php endforeach; ?>
				</ul>
				</div>
			</div>
			<div class="col-md-10 col-sm-12 col-xs-12">
				
				<div class="lecture-index">
					<h2 class="bgcolor1-bold hidden-xs"><?php echo @$cautaotu['name']?></h2>
					<div class="lecture-left">
						<?php foreach($basicChildren as $item): ?>
						<div class="lecture-item blcolor1-bold num<?php echo $index ?>">
							<div class="lecture-title color1-bold"><a href="/<?php echo @$item['alias']?>"><?php echo @$item['name']?></a></div>
							<div class="lecture-detail"><a href="/<?php echo @$item['alias']?>">Bài giảng</a></div>
							<div class="lecture-practice"><a href="/<?php echo @$item['alias']?>">Bài tập</a></div>
							<?php  $index++; ?>
						</div>
						<?php endforeach; ?>
					</div>
					<div class="lecture-right">
						<?php foreach($advanceChildren as $item): ?>
						<div class="lecture-item blcolor1-bold num<?php echo $index ?>">
							<div class="lecture-title color1-bold"><a href="/<?php echo @$item['alias']?>"><?php echo @$item['name']?></a></div>
							<div class="lecture-detail"><a href="/<?php echo @$item['alias']?>">Bài giảng</a></div>
							<div class="lecture-practice"><a href="/<?php echo @$item['alias']?>">Bài tập</a></div>
							<?php  $index++; ?>
						</div>
						<?php endforeach; ?>
					</div>
					<div class="lecture-girl-cartoon hidden-xs"></div>
					<div class="clear"></div>
				</div>
			</div>
		</div>
	</div>
</div>