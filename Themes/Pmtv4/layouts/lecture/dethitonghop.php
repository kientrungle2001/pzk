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
$childs 			=	($week['id'] == $data->get('menuId')) ? $week['children'] : (($year['id'] == $data->get('menuId')) ?  $year['children'] : $terms['children']);
$index				=	1;
$tab 				= 	null;
$tabType			= 	null;
if($week['id'] == $data->get('menuId')) {
	$tab			= 	$week;
	$tabType		=	'week';
} elseif($year['id'] == $data->get('menuId')) {
	$tab			= 	$year;
	$tabType		=	'year';
} else {
	$tab			=	$terms;
	$tabType		=	'term';
}
?>
<div class="lecture-region {root[alias]}">
	<div class="lecture-bird-2"></div>
	<div class="container">
		<h1 class="text-center color6-bold">{root[name]}</h1>
		<div class="row columns-lecture">
			<div class="col-md-1">&nbsp;</div>
			<div class="col-md-10 ">
				
				<div class="lecture-index">
					<h2 class="tab1 bgcolor6-bold"><a href="/{week[alias]}">{week[name]}</a></h2>
					<h2 class="tab2 bgcolor6-bold hidden"><a href="/{terms[alias]}">{terms[name]}</a></h2>
					<h2 class="tab2 bgcolor6-bold"><a href="/{year[alias]}">{year[name]}</a></h2>
					<?php if($tabType	== 'term'):?>
					
					<div class="row" style="padding-top: 30px;">
						<div class="col-md-2"></div>
						<div class="col-md-4">
							<center><h3 class="lecture-section-heading">{term1[name]}</h3></center>
							<div class="row">
							{each $term1children as $child}
								<div class="col-sm-3 top-25 lecture-title">
									<a class="color1-bold" href="/{child[alias]}">{child[name]}</a>
								</div>
							{/each}
							</div>
						</div>
						<div class="col-md-4">
							<center><h3 class="lecture-section-heading">{term2[name]}</h3></center>
							<div class="row">
							{each $term2children as $child}
								<div class="col-sm-3 top-25 lecture-title">
									<a class="color1-bold" href="/{child[alias]}">{child[name]}</a>
								</div>
							{/each}
							</div>
						</div>
						<div class="col-md-2"></div>
					</div>
					<?php else:?>
					<div class="row" style="padding-top: 30px;">
						<div class="col-md-2"></div>
						<div class="col-md-9">
							<div class="row">
							{each $childs as $child}
								<div class="col-sm-2 top-25 lecture-title">
									<a class="color1-bold" href="/{child[alias]}">{child[name]}</a>
								</div>
							{/each}
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