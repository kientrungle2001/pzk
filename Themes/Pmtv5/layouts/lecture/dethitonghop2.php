<?php 
$items 				= 	$data->getItems(); 
$items 				= 	buildTree($items);
$root 				= 	$items[0];
$children 			= 	$root['children'];
?>
<div class="lecture-region {root[alias]}">
	<div class="lecture-bird-2"></div>
	<div class="container">
		<h1 class="text-center color6-bold">{root[name]}</h1>
		<div class="row columns-lecture">
			<div class="col-md-1">&nbsp;</div>
			<div class="col-md-10 ">
				
				<div class="lecture-index">
					<div class="row" style="padding-top: 30px;">
						<div class="col-md-2"></div>
						<div class="col-md-8">
							<div class="row">
							{each $children as $child}
								<div class="col-sm-3 top-25 lecture-title">
									<div class="table-bordered padding-5 bdcolor6 text-center bgcolor6-bold">
										<a class="color-white font-large" href="/{child[alias]}">{child[name]}</a>
									</div>
								</div>
							{/each}
							</div>
						</div>
						<div class="col-md-2"></div>
					</div>
					<div class="lecture-girl-cartoon lecture-kids-cartoon hidden-xs"></div>
				</div>
			</div>
			<div class="col-md-1">&nbsp;</div>
		</div>
	</div>
</div>