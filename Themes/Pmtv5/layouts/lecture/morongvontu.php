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
<div class="lecture-region {root[alias]}">
	<div class="lecture-bird-2 hidden-xs"></div>
	<div class="container">
		<h1 class="text-center">{root[name]}</h1>
		<div class="row columns-lecture">
			<div class="col-xs-12">
				
				<div class="lecture-index">
					<h2 class="bgcolor3-bold hidden-xs">{root[name]}</h2>
					<div class="lecture-left">
						{each $basicChildren1 as $item}
						<div class="lecture-item blcolor3-bold num{index}" style="min-height: 140px">
							<div class="lecture-title color3-bold"><a href="/{item[alias]}">{item[name]}</a></div>
							<?php for($i = 0; $i < 9; $i++):
							$j = $i;
							if($i == 0) {
								$j = '';
							}
							if(!isset($item['video' . $j]) || !$item['video' . $j]) continue;
							?>
							<div class="lecture-detail" style="white-space: normal">
							<a href="/{item[alias]}?video={j}"><?php echo $item['video' . $j . '_title']?></a>
							</div>
							<?php endfor;?>
							<div class="lecture-practice bottom-25"><a href="/{item[alias]}">Bài tập</a></div>
							<div class="lecture-image hidden-xs"><img class="img-responsive" src="{item[img]}" /></div>
						</div>
						{? $index++; ?}
						{/each}
					</div>
					<div class="lecture-right">
						{each $advanceChildren1 as $item}
						<div class="lecture-item blcolor3-bold num{index}" style="min-height: 140px">
							<div class="lecture-title color3-bold"><a href="/{item[alias]}">{item[name]}</a></div>
							<?php for($i = 0; $i < 9; $i++):
							$j = $i;
							if($i == 0) {
								$j = '';
							}
							if(!isset($item['video' . $j]) || !$item['video' . $j]) continue;
							?>
							<div class="lecture-detail" style="white-space: normal">
							<a href="/{item[alias]}?video={j}"><?php echo $item['video' . $j . '_title']?></a>
							</div>
							<?php endfor;?>
							<div class="lecture-practice bottom-25"><a href="/{item[alias]}">Bài tập</a></div>
							<div class="lecture-image hidden-xs"><img class="img-responsive" src="{item[img]}" /></div>
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