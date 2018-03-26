<?php
$items 				= 	$data->getItems(); 
$items 				= 	buildTree($items);
$root				= 	$items[0];
$sections			= 	$root['children'];
?>
<div class="lecture-region {root[alias]}">
	<div class="container"><h1 class="text-center color1-bold">{root[name]}</h1>
	<div class="row columns-lecture"><div class="col-xs-12">
		<div class="lecture-index">
		{each $sections as $section}
			<center>
			<h3 class="lecture-section-heading top20">{section[name]}</h3>
			</center>
			{? $items = $section['children']; 
			$basic = $items[0];
			$advance = @$items[1];
			$basicChildren = array();
			$advanceChildren = array();
			if(isset($basic['children'])) {
				$basicChildren = $basic['children'];
				$advanceChildren = $advance['children'];	
			} else {
				$countItems = count($items);
				foreach($items as $itemIndex => $item) {
					if($itemIndex < $countItems / 2) {
						$basicChildren[] = $item;
					} else {
						$advanceChildren[] = $item;
					}
				}
			}
			
			?}
			
					<div class="lecture-left">
						<h3 class="lecture-section-heading lecture-basic bgcolor1 hidden">{basic[name]}</h3>
						{? 	$index = 1; ?}
						{each $basicChildren as $item}
						<div class="lecture-item blcolor1-bold num{index}">
							<div class="lecture-title color1-bold"><a href="/{item[alias]}">{item[name]}</a></div>
							<?php if(@$item['content'] || @$item['video']):?>
								<?php for($i = 0; $i < 9; $i++):
							$j = $i;
							if($i == 0) {
								$j = '';
							}
							if(!isset($item['video' . $j]) || !$item['video' . $j]) continue;
							?>
							<div class="lecture-detail" style="width: 100%; white-space: normal;">
							<a href="/{item[alias]}?video={j}"><?php echo $item['video' . $j . '_title']?></a>
							</div>
							<?php endfor;?>
							<?php endif;?>
							<div class="lecture-practice" style="width: 100%; white-space: normal;"><a href="/{item[alias]}#practice-section" style="position: relative; top: -4px;">Bài tập</a></div>
							<div class="clear"></div>
						</div>
						{?	$index++; ?}
						{/each}
					</div>
					<div class="lecture-right">
						<h3 class="lecture-section-heading lecture-advance bgcolor1 hidden">{advance[name]}</h3>
						
						{each $advanceChildren as $item}
						<div class="lecture-item blcolor1-bold num{index}">
							<div class="lecture-title color1-bold"><a href="/{item[alias]}">{item[name]}</a></div>
							<?php if(@$item['content'] || @$item['video']):?>
								<?php for($i = 0; $i < 9; $i++):
							$j = $i;
							if($i == 0) {
								$j = '';
							}
							if(!isset($item['video' . $j]) || !$item['video' . $j]) continue;
							?>
							<div class="lecture-detail" style="width: 100%; white-space: normal;">
							<a href="/{item[alias]}?video={j}"><?php echo $item['video' . $j . '_title']?></a>
							</div>
							<?php endfor;?>
							<?php endif;?>
							<div class="lecture-practice" style="width: 100%; white-space: normal;"><a href="/{item[alias]}#practice-section" style="position: relative; top: -4px;">Bài tập</a></div>
							<div class="clear"></div>
						</div>
						{?	$index++; ?}
						{/each}
					</div>
					<div class="clear"></div>
		{/each}
		</div>
	</div></div>
	</div>
</div>