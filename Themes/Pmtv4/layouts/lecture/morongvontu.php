<?php 
$items 				= 	$data->getItems(); 
$items 				= 	buildTree($items);
$root 				= 	$items[0];
$children 			= 	$root['children'];
$childrenCount		=	count($children);
$chunks 			=	array_chunk($children, ceil($childrenCount / 2));
$basicChildren1		=	$chunks[0];
$advanceChildren1	=	$chunks[1];
$index				=	1;
?>
<div class="lecture-region <?php echo @$root['alias']?>">
	<div class="lecture-bird-2 hidden-xs"></div>
	<div class="container">
		<h1 class="text-center color3-bold"><?php echo @$root['name']?></h1>
		<div class="row columns-lecture">
			<div class="col-xs-12">
				
				<div class="lecture-index">
					<div class="lecture-left">
						<?php foreach($basicChildren1 as $item): ?>
						<div class="lecture-item blcolor3-bold num<?php echo $index ?>">
							<div class="lecture-title color3-bold"><a href="/<?php echo @$item['alias']?>"><?php echo @$item['name']?></a></div>
							<?php if($item['video']):?>
							<?php for($i = 0; $i < 9; $i++):
							$j = $i;
							if($i == 0) {
								$j = '';
							}
							if(!isset($item['video' . $j]) || !$item['video' . $j]) continue;
							?>
							<div class="lecture-detail" style="width: 100%; white-space: normal;">
							<a href="/<?php echo @$item['alias']?>?video=<?php echo $j ?>"><?php echo $item['video' . $j . '_title']?></a>
							</div>
							<?php endfor;?>
							<?php endif;?>
							<div class="lecture-practice bottom-25"><a href="/<?php echo @$item['alias']?>#practice-section">Bài tập</a></div>
							<div class="lecture-image hidden"><img class="img-responsive" src="<?php echo @$item['img']?>" /></div>
						</div>
						<?php  $index++; ?>
						<?php endforeach; ?>
					</div>
					<div class="lecture-right">
						<?php foreach($advanceChildren1 as $item): ?>
						<div class="lecture-item blcolor3-bold num<?php echo $index ?>">
							<div class="lecture-title color3-bold"><a href="/<?php echo @$item['alias']?>"><?php echo @$item['name']?></a></div>
							<?php for($i = 0; $i < 9; $i++):
							$j = $i;
							if($i == 0) {
								$j = '';
							}
							if(!isset($item['video' . $j]) || !$item['video' . $j]) continue;
							?>
							<div class="lecture-detail" style="width: 100%; white-space: normal;">
							<a href="/<?php echo @$item['alias']?>?video=<?php echo $j ?>"><?php echo $item['video' . $j . '_title']?></a>
							</div>
							<?php endfor;?>
							<div class="lecture-practice bottom-25"><a href="/<?php echo @$item['alias']?>">Bài tập</a></div>
							<div class="lecture-image hidden"><img class="img-responsive" src="<?php echo @$item['img']?>" /></div>
						</div>
						<?php  $index++; ?>
						<?php endforeach; ?>
					</div>
					<div class="clear"></div>
				</div>
			</div>
		</div>
	</div>
</div>