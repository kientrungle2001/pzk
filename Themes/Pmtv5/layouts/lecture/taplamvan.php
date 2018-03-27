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
<div class="lecture-region {root[alias]}">
	<div class="lecture-bird-2 hidden-xs"></div>
	<div class="container">
		<h1 class="text-center color5-bold">{root[name]}</h1>
		<div class="row columns-lecture">
			<div class="col-xs-12">
				
				<div class="lecture-index">
					<div class="lecture-left">
						{each $basicChildren1 as $item}
						<div class="blcolor5-bold relative">
							<h3 class="lecture-title color5-bold"><a href="/{item[alias]}">{item[name]}</a></h3>
							<ul class="relative" style="z-index: 5; list-style-type: none;">
							{? foreach($item['children'] as $childIndex => $child):?}
								<li class="lecture-item top-10 num{? echo $childIndex + 1; ?}"><a href="/{child[alias]}">{child[name]}</a>
								
								<?php for($i = 0; $i < 9; $i++):
							$j = $i;
							if($i == 0) {
								$j = '';
							}
							if(!isset($child['video' . $j]) || !$child['video' . $j]) continue;
							?>
							<div class="lecture-detail" style="white-space: normal;">
							<a href="/{child[alias]}?video={j}"><?php echo $child['video' . $j . '_title']?></a>
							</div>
							<?php endfor;?>
								
								</li>
							{? endforeach;?}
							</ul>
							
							<div class="text-right absolute absolute-top absolute-right hidden-xs">
								<img style="width: 120px;height: auto; opacity: 0.7;" src="{item[img]}" />
							</div>
						</div>
						{? $index++; ?}
						{/each}
					</div>
					<div class="lecture-right">
						{each $advanceChildren1 as $item}
						<div class="blcolor5-bold relative">
							<h3 class="lecture-title color5-bold"><a href="/{item[alias]}">{item[name]}</a></h3>
							<ul class="relative" style="z-index: 5; list-style-type: none;">
							{? foreach($item['children'] as $childIndex => $child):?}
								<li class="lecture-item num{? echo $childIndex + 1; ?} top-10"><a href="/{child[alias]}">{child[name]}</a>
								<?php for($i = 0; $i < 9; $i++):
								$j = $i;
								if($i == 0) {
									$j = '';
								}
								if(!isset($child['video' . $j]) || !$child['video' . $j]) continue;
								?>
								<div class="lecture-detail" style="white-space: normal;">
								<a href="/{child[alias]}?video={j}"><?php echo $child['video' . $j . '_title']?></a>
								</div>
								<?php endfor;?>
								</li>
							{? endforeach;?}
							</ul>
							<div class="text-right absolute absolute-top absolute-right">
								<img style="width: 120px;height: auto; opacity: 0.7;" src="{item[img]}" />
							</div>
						</div>
						{? $index++; ?}
						{/each}
					</div>
					<div class="clear"></div>
				</div>
			</div>
		</div>
	</div>
</div>