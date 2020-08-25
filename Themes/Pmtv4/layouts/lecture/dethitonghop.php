<?php 
$items 				= 	$data->getItems(); 
$items 				= 	buildTree($items);
$root 				= 	$items[0];
$children 			= 	$root['children'];
$week				=	$children[0];
$terms				=	$children[1];
$term1 				= 	$terms['children'][0];
$term1children		=	$term1['children'];
$term2 				= 	$terms['children'][1];
$term2children		=	$term2['children'];
$year				=	$children[2];
$childs 			=	($week['id'] == $data->getMenuId()) ? $week['children'] : (($year['id'] == $data->getMenuId()) ?  $year['children'] : $terms['children']);
$index				=	1;
$tab 				= 	null;
$tabType			= 	null;
if($week['id'] == $data->getMenuId()) {
	$tab			= 	$week;
	$tabType		=	'week';
} elseif($year['id'] == $data->getMenuId()) {
	$tab			= 	$year;
	$tabType		=	'year';
} else {
	$tab			=	$terms;
	$tabType		=	'term';
}
?>
<div class="lecture-region <?php echo @$root['alias']?>">
	<div class="lecture-bird-2"></div>
	<div class="container">
		<h1 class="text-center color6-bold"><?php echo @$root['name']?></h1>
		<div class="row columns-lecture">
			<div class="col-md-1">&nbsp;</div>
			<div class="col-md-10 ">
				
				<div class="lecture-index">
					<h2 class="tab1 bgcolor6-bold"><a href="/<?php echo @$week['alias']?>"><?php echo @$week['name']?></a></h2>
					<h2 class="tab2 bgcolor6-bold hidden"><a href="/<?php echo @$terms['alias']?>"><?php echo @$terms['name']?></a></h2>
					<h2 class="tab2 bgcolor6-bold"><a href="/<?php echo @$year['alias']?>"><?php echo @$year['name']?></a></h2>
					<?php if($tabType	== 'term'):?>
					
					<div class="row" style="padding-top: 30px;">
						<div class="col-md-2"></div>
						<div class="col-md-4">
							<center><h3 class="lecture-section-heading"><?php echo @$term1['name']?></h3></center>
							<div class="row">
							<?php foreach($term1children as $child): ?>
								<div class="col-sm-3 top-25 lecture-title">
									<a class="color1-bold" href="/<?php echo @$child['alias']?>"><?php echo @$child['name']?></a>
								</div>
							<?php endforeach; ?>
							</div>
						</div>
						<div class="col-md-4">
							<center><h3 class="lecture-section-heading"><?php echo @$term2['name']?></h3></center>
							<div class="row">
							<?php foreach($term2children as $child): ?>
								<div class="col-sm-3 top-25 lecture-title">
									<a class="color1-bold" href="/<?php echo @$child['alias']?>"><?php echo @$child['name']?></a>
								</div>
							<?php endforeach; ?>
							</div>
						</div>
						<div class="col-md-2"></div>
					</div>
					<?php else:?>
					<div class="row" style="padding-top: 30px;">
						<div class="col-md-2"></div>
						<div class="col-md-9">
							<div class="row">
							<?php foreach($childs as $child): ?>
								<div class="col-sm-2 top-25 lecture-title">
									<a class="color1-bold" href="/<?php echo @$child['alias']?>"><?php echo @$child['name']?></a>
								</div>
							<?php endforeach; ?>
							</div>
						</div>
						<div class="col-md-1"></div>
					</div>
					<?php endif;?>
					<div class="lecture-girl-cartoon lecture-kids-cartoon hidden-xs"></div>
				</div>
			</div>
			<div class="col-md-1">&nbsp;</div>
		</div>
	</div>
</div>