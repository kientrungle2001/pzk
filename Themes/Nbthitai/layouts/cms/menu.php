<?php 
$items = $data->getItems();
$items = buildTree($items);
$index = 2;
?>
<ul class="nav nav-justified robotofont"> 
	{each $items as $item}
	{? if(strpos($item['router'], 'http://') === false) { 
			$link = '/'. $item['alias']; 
		} else {
			$link = $item['router'];
		}
	?}
	<li class="dropdown bdr{index}">
		<a href="{link}">{item[name]} <span class="caret"></span></a>
		{? $children = @$item['children']; ?}
		{? if ($children) : ?}
		<ul class="dropdown-menu robotofont">
			{each $children as $child}
			{? if(strpos($child['router'], 'http://') === false) { 
					$link = '/'. $child['alias']; 
				} else {
					$link = $child['router'];
				}
			?}
			<li class="dropdown"><a href="{link}">{child[name]}</a>
			{? $subChildren = @$child['children']; ?}
			{? if ($subChildren) : ?}
			<ul class="dropdown robotofont">
			{each $subChildren as $subChild}
			{? if(strpos($subChild['router'], 'http://') === false) { 
					$link = '/'. $subChild['alias']; 
				} else {
					$link = $subChild['router'];
				}
			?}
				<li><a href="{link}">{subChild[name]}</a></li>
			{/each}
			</ul>
			{? endif; ?}
			</li>
			{/each}
		</ul>
		{? endif; ?}
	</li> 
	{? $index++; ?}
	{/each}
</ul>