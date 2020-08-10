<?php 
$items 				= 	$data->getItems(); 
$items 				= 	buildTree($items);
$root 				= 	$items[0];
$children 			= 	$root['children'];
$childrenCount 		= 	count($children);
$chunks 			=	array_chunk($children, ceil( $childrenCount / 4 ) );
$chunks3			= 	array_chunk($children, ceil( $childrenCount / 3 ) );
//debug($chunks);
$basicChildren1		=	$chunks[0];
$basicChildren2		=	$chunks[1];
$advanceChildren1	=	$chunks[2];
$advanceChildren2	=	$chunks[3];
$item = array_pop($advanceChildren1);
array_unshift($advanceChildren2, $item);

$col1Items			= 	$chunks3[0];
$col2Items			= 	$chunks3[1];
$col3Items			= 	$chunks3[2];

$index 				= 	1;
?>
<div class="lecture-region <?php echo @$root['alias']?>">
	<div class="lecture-bird-2 hidden-xs"></div>
	<div class="container">
		<h1 class="text-center color2-bold">Chính tả</h1>
		<div class="row columns-lecture">
			<div class="col-xs-12">
				
				<div class="lecture-index">
					<h2 class="bgcolor2-bold hidden-xs"><?php echo @$root['name']?></h2>
					<div class="lecture-left hidden-md hidden-sm hidden-xs">
						<div class="left">
							<?php foreach($basicChildren1 as $item): ?>
							<div class="lecture-item blcolor2-bold num<?php echo $index ?>">
								<div class="lecture-title color2-bold"><a href="/<?php echo @$item['alias']?>"><?php echo @$item['name']?></a></div>
								<div class="lecture-detail"><a href="/<?php echo @$item['alias']?>">Bài giảng</a></div>
								<div class="lecture-practice"><a href="/<?php echo @$item['alias']?>">Bài tập</a></div>
							</div>
							<?php 	$index++; ?>
							<?php endforeach; ?>
						</div>
						<div class="right">
							<?php foreach($basicChildren2 as $item): ?>
							<div class="lecture-item blcolor2-bold num<?php echo $index ?>">
								<div class="lecture-title color2-bold"><a href="/<?php echo @$item['alias']?>"><?php echo @$item['name']?></a></div>
								<div class="lecture-detail"><a href="/<?php echo @$item['alias']?>">Bài giảng</a></div>
								<div class="lecture-practice"><a href="/<?php echo @$item['alias']?>">Bài tập</a></div>
							</div>
							<?php 	$index++; ?>
							<?php endforeach; ?>
						</div>
					</div>
					<div class="lecture-right hidden-md hidden-sm hidden-xs">
						<div class="left">
							<?php foreach($advanceChildren1 as $item): ?>
							<div class="lecture-item blcolor2-bold num<?php echo $index ?>">
								<div class="lecture-title color2-bold"><a href="/<?php echo @$item['alias']?>"><?php echo @$item['name']?></a></div>
								<div class="lecture-detail"><a href="/<?php echo @$item['alias']?>">Bài giảng</a></div>
								<div class="lecture-practice"><a href="/<?php echo @$item['alias']?>">Bài tập</a></div>
							</div>
							<?php 	$index++; ?>
							<?php endforeach; ?>
						</div>
						<div class="right">
							<?php foreach($advanceChildren2 as $item): ?>
							<div class="lecture-item blcolor2-bold num<?php echo $index ?>">
								<div class="lecture-title color2-bold"><a href="/<?php echo @$item['alias']?>"><?php echo @$item['name']?></a></div>
								<div class="lecture-detail"><a href="/<?php echo @$item['alias']?>">Bài giảng</a></div>
								<div class="lecture-practice"><a href="/<?php echo @$item['alias']?>">Bài tập</a></div>
							</div>
							<?php 	$index++; ?>
							<?php endforeach; ?>
						</div>
					</div>
					<?php 
					$index	= 1;
					for($i = 1; $i < 4; $i++): 
					$colItemsVarName = 'col' . $i . 'Items';
					$colItems = $$colItemsVarName;
					$pd10 = ($i == 1)? 'pd-10-percent' : '';
					$smwidth = 4;
					?>
					<div class="col-sm-<?php echo $smwidth ?> hidden-lg hidden-xs <?php echo $pd10 ?> pd-top-30">
						<?php foreach($colItems as $item): ?>
						<div class="lecture-item blcolor2-bold num<?php echo $index ?>">
							<div class="lecture-title color2-bold"><a href="/<?php echo @$item['alias']?>"><?php echo @$item['name']?></a></div>
							<div class="lecture-detail"><a href="/<?php echo @$item['alias']?>">Bài giảng</a></div>
							<div class="lecture-practice"><a href="/<?php echo @$item['alias']?>">Bài tập</a></div>
						</div>
						<?php 	$index++; ?>
						<?php endforeach; ?>
					</div>
					<?php endfor; 
					$index = 1;
					?>
					<div class="col-xs-12 visible-xs">
						<?php foreach($children as $item): ?>
						<div class="lecture-item blcolor2-bold num<?php echo $index ?>">
							<div class="lecture-title color2-bold"><a href="/<?php echo @$item['alias']?>"><?php echo @$item['name']?></a></div>
							<div class="lecture-detail"><a href="/<?php echo @$item['alias']?>">Bài giảng</a></div>
							<div class="lecture-practice"><a href="/<?php echo @$item['alias']?>">Bài tập</a></div>
						</div>
						<?php 	$index++; ?>
						<?php endforeach; ?>
					</div>
					<div class="lecture-girl-cartoon lecture-children-cartoon hidden-xs"></div>
					<div class="clear"></div>
				</div>
			</div>
		</div>
	</div>
</div>