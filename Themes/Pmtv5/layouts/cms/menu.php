{? $items = $data->getItems();?}
<div class="container-menu">
	<div class="row">
		<div class="col-xs-12">
		  <ul id="mainMenu" style="background: none;">
		{? 	foreach($items as $index => $item): 
			$indexInc = $index; ?}
		
			<li class="relative">
				<?php if($item['alias'] == 'thi-thu'):?>
				<button onclick="window.location='/{item[alias]}';" href="/{item[alias]}" class="btn btn-danger" style="width: 100%; padding: 15px;">
					{item[name]}
				</button>	
				<?php else:?>
				<a href="/{item[alias]}">
					{item[name]}
				</a>
				<?php endif; ?>
			</li>
		{? 	endforeach;?}
		  </ul>
		</div>
	</div>
</div>