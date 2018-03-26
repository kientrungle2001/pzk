{? $items = $data->getItems();?}
<div class="container">
	<div class="row">
		<div class="col-xs-12">
		  <ul id="mainMenu" style="background: none;">
		{? 	foreach($items as $index => $item): 
			$indexInc = $index; ?}
		<?php if($item['router'] !== 'home/index'):?>
			<li class="text-center"><a href="/{item[alias]}"><img src="{item[img]}" style="height: 57px; width: auto;" /></a></li>
		<?php else:?>
			<li class="relative hidden-xs">
				<a href="/{item[alias]}">
					<img src="/Themes/pmtv5/skin/media/home-icon.png" class="absolute" style="top: -20px; left: 10px;" />&nbsp;</a>
			</li>
		<?php endif;?>
		{? 	endforeach;?}
		  </ul>
		</div>
	</div>
</div>