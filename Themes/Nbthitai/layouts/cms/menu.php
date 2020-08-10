<?php 
$items = $data->getItems();
$items = buildTree($items);
$index = 2;
?>
<ul class="nav nav-justified robotofont"> 
	<?php foreach($items as $item): ?>
	<?php  if(strpos($item['router'], 'http://') === false) { 
			$link = '/'. $item['alias']; 
		} else {
			$link = $item['router'];
		}
	?>
	<li class="dropdown bdr<?php echo $index ?>">
		<a href="<?php echo $link ?>"><?php echo @$item['name']?> <span class="caret"></span></a>
		<?php  $children = @$item['children']; ?>
		<?php  if ($children) : ?>
		<ul class="dropdown-menu robotofont">
			<?php foreach($children as $child): ?>
			<?php  if(strpos($child['router'], 'http://') === false) { 
					$link = '/'. $child['alias']; 
				} else {
					$link = $child['router'];
				}
			?>
			<li class="dropdown"><a href="<?php echo $link ?>"><?php echo @$child['name']?></a>
			<?php  $subChildren = @$child['children']; ?>
			<?php  if ($subChildren) : ?>
			<ul class="dropdown robotofont">
			<?php foreach($subChildren as $subChild): ?>
			<?php  if(strpos($subChild['router'], 'http://') === false) { 
					$link = '/'. $subChild['alias']; 
				} else {
					$link = $subChild['router'];
				}
			?>
				<li><a href="<?php echo $link ?>"><?php echo @$subChild['name']?></a></li>
			<?php endforeach; ?>
			</ul>
			<?php  endif; ?>
			</li>
			<?php endforeach; ?>
		</ul>
		<?php  endif; ?>
	</li> 
	<?php  $index++; ?>
	<?php endforeach; ?>
</ul>