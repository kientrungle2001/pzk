<?php 
$items 				= 	$data->getItems(); 

$items 				= 	buildTree($items);
$root 				= 	$items[0];
$children 			= 	$root['children'];
$chunks 			=	array_chunk($children, 2);
$basicChildren1		=	$chunks[0];
$advanceChildren1	=	$chunks[1];
$index				=	1;
?>
<div class="lecture-region <?php echo @$root['alias']?>">
	<div class="lecture-bird-2 hidden-xs"></div>
	<div class="container">
		<h1 class="text-center color5-bold"><?php echo @$root['name']?></h1>
		<div class="row columns-lecture">
			<div class="col-xs-12">
				
				<div class="lecture-index">
					<div class="lecture-left">
						<?php foreach($basicChildren1 as $item): ?>
						<div class="blcolor5-bold relative">
							<h3 class="lecture-title color5-bold"><a href="/<?php echo @$item['alias']?>"><?php echo @$item['name']?></a></h3>
							<ul class="relative" style="z-index: 5; list-style-type: none;">
							<?php  foreach($item['children'] as $childIndex => $child):?>
								<li class="lecture-item top-10 num<?php  echo $childIndex + 1; ?>"><a href="/<?php echo @$child['alias']?>"><?php echo @$child['name']?></a>
								
								<?php for($i = 0; $i < 9; $i++):
							$j = $i;
							if($i == 0) {
								$j = '';
							}
							if(!isset($child['video' . $j]) || !$child['video' . $j]) continue;
							?>
							<div class="lecture-detail" style="white-space: normal;">
							<a href="/<?php echo @$child['alias']?>?video=<?php echo $j ?>"><?php echo $child['video' . $j . '_title']?></a>
							</div>
							<?php endfor;?>
								
								</li>
							<?php  endforeach;?>
							</ul>
							
							<div class="text-right absolute absolute-top absolute-right hidden-xs">
								<img style="width: 120px;height: auto; opacity: 0.7;" src="<?php echo @$item['img']?>" />
							</div>
						</div>
						<?php  $index++; ?>
						<?php endforeach; ?>
					</div>
					<div class="lecture-right">
						<?php foreach($advanceChildren1 as $item): ?>
						<div class="blcolor5-bold relative">
							<h3 class="lecture-title color5-bold"><a href="/<?php echo @$item['alias']?>"><?php echo @$item['name']?></a></h3>
							<ul class="relative" style="z-index: 5; list-style-type: none;">
							<?php  foreach($item['children'] as $childIndex => $child):?>
								<li class="lecture-item num<?php  echo $childIndex + 1; ?> top-10"><a href="/<?php echo @$child['alias']?>"><?php echo @$child['name']?></a>
								<?php for($i = 0; $i < 9; $i++):
								$j = $i;
								if($i == 0) {
									$j = '';
								}
								if(!isset($child['video' . $j]) || !$child['video' . $j]) continue;
								?>
								<div class="lecture-detail" style="white-space: normal;">
								<a href="/<?php echo @$child['alias']?>?video=<?php echo $j ?>"><?php echo $child['video' . $j . '_title']?></a>
								</div>
								<?php endfor;?>
								</li>
							<?php  endforeach;?>
							</ul>
							<div class="text-right absolute absolute-top absolute-right">
								<img style="width: 120px;height: auto; opacity: 0.7;" src="<?php echo @$item['img']?>" />
							</div>
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