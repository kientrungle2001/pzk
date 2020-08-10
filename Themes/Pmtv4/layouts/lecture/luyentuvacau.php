<?php
$items 				= 	$data->getItems(); 
$items 				= 	buildTree($items);
$root				= 	$items[0];
$sections			= 	$root['children'];
?>
<div class="lecture-region <?php echo @$root['alias']?>">
	<div class="container"><h1 class="text-center color1-bold"><?php echo @$root['name']?></h1>
	<div class="row columns-lecture"><div class="col-xs-12">
		<div class="lecture-index">
		<?php foreach($sections as $section): ?>
			<center>
			<h3 class="lecture-section-heading top20"><?php echo @$section['name']?></h3>
			</center>
			<?php  $items = $section['children']; 
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
			
			?>
			
					<div class="lecture-left">
						<h3 class="lecture-section-heading lecture-basic bgcolor1 hidden"><?php echo @$basic['name']?></h3>
						<?php  	$index = 1; ?>
						<?php foreach($basicChildren as $item): ?>
						<div class="lecture-item blcolor1-bold num<?php echo $index ?>">
							<div class="lecture-title color1-bold"><a href="/<?php echo @$item['alias']?>"><?php echo @$item['name']?></a></div>
							<?php if(@$item['content'] || @$item['video']):?>
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
							<div class="lecture-practice" style="width: 100%; white-space: normal;"><a href="/<?php echo @$item['alias']?>#practice-section" style="position: relative; top: -4px;">Bài tập</a></div>
							<div class="clear"></div>
						</div>
						<?php 	$index++; ?>
						<?php endforeach; ?>
					</div>
					<div class="lecture-right">
						<h3 class="lecture-section-heading lecture-advance bgcolor1 hidden"><?php echo @$advance['name']?></h3>
						
						<?php foreach($advanceChildren as $item): ?>
						<div class="lecture-item blcolor1-bold num<?php echo $index ?>">
							<div class="lecture-title color1-bold"><a href="/<?php echo @$item['alias']?>"><?php echo @$item['name']?></a></div>
							<?php if(@$item['content'] || @$item['video']):?>
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
							<div class="lecture-practice" style="width: 100%; white-space: normal;"><a href="/<?php echo @$item['alias']?>#practice-section" style="position: relative; top: -4px;">Bài tập</a></div>
							<div class="clear"></div>
						</div>
						<?php 	$index++; ?>
						<?php endforeach; ?>
					</div>
					<div class="clear"></div>
		<?php endforeach; ?>
		</div>
	</div></div>
	</div>
</div>