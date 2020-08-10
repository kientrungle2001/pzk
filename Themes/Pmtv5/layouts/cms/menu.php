<?php  $items = $data->getItems();?>
<div class="container-menu">
	<div class="row">
		<div class="col-xs-12">
		  <ul id="mainMenu" style="background: none;">
		<?php  	foreach($items as $index => $item): 
			$indexInc = $index; ?>
		
			<li class="relative">
				<?php if($item['alias'] == 'thi-thu'):?>
				<button onclick="window.location='/<?php echo @$item['alias']?>';" href="/<?php echo @$item['alias']?>" class="btn btn-danger" style="width: 100%; padding: 15px;">
					<?php echo @$item['name']?>
				</button>	
				<?php else:?>
				<a href="/<?php echo @$item['alias']?>">
					<?php echo @$item['name']?>
				</a>
				<?php endif; ?>
			</li>
		<?php  	endforeach;?>
		  </ul>
		</div>
	</div>
</div>