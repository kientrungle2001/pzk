{? $items = $data->getItems();?}
<div class="container">
	<div class="row">
		<div class="cls-main-menu">
		<!--button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mainMenu"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button-->
		  <ul id="mainMenu" class="nav navbar-nav">
		{? 	foreach($items as $index => $item): $indexInc = $index; ?}
			<li class="bgcolor{indexInc}-bold"><a href="/{item[alias]}" class="auto-font">{item[name]}</a></li>
		{? 	endforeach;?}
		  </ul>
		</div>
	</div>
</div>