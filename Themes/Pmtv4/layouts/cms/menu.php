<?php  $items = $data->getItems();?>
<div class="container">
	<div class="row">
		<div class="<?php echo pzk_theme_css_class('main-menu')?>">
		<!--button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mainMenu"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button-->
		  <ul id="mainMenu" class="nav navbar-nav">
		<?php  	foreach($items as $index => $item): $indexInc = $index; ?>
			<li class="bgcolor<?php echo $indexInc ?>-bold"><a href="/<?php echo @$item['alias']?>" class="auto-font"><?php echo @$item['name']?></a></li>
		<?php  	endforeach;?>
		  </ul>
		</div>
	</div>
</div>