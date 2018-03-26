<?php 
$items 				= 	$data->getItems(); 
$items 				= 	buildTree($items);
$root 				= 	$items[0];
$children 			= 	$root['children'];
?>
<div class="lecture-region {root[alias]}">
	<div class="lecture-bird-2 hidden-xs"></div>
	<div class="container">
		<h1 class="text-center">{root[name]}</h1>
		<div class="row columns-lecture">
			<div class="col-xs-12">
				<div class="lecture-index">
				{each $children as $section}
					<div class="row">
						<div class="col-md-2 hidden-xs hidden-sm">&nbsp;</div>
						<div class="col-md-9 col-xs-12 col-sm-12">
							<center><h3 class="lecture-section-heading">{section[name]}</h3></center>
							<div class="row">
							{?	$subs 	= 	$section['children'];
								$index	=	1;
							?}
								{each $subs as $sub}
								<div class="col-xs-12 col-md-6">
									<div class="lecture-item blcolor4-bold num{index}">
										<div class="lecture-title color4-bold"><a href="/{sub[alias]}">{sub[name]}</a></div>
										
										<?php for($i = 0; $i < 9; $i++):
										$j = $i;
										if($i == 0) {
											$j = '';
										}
										if(!isset($sub['video' . $j]) || !$sub['video' . $j]) continue;
										?>
										<div class="lecture-detail">
										<a href="/{sub[alias]}?video={j}"><?php echo $sub['video' . $j . '_title']?></a>
										</div>
										<?php endfor;?>
										
										
										<div class="lecture-practice"><a href="/{sub[alias]}">Bài tập</a></div>
									</div>
								</div>
								{? 	$index++; ?}
								{/each}
							</div>
						</div>
						<div class="col-md-1 hidden-xs hidden-sm">&nbsp;</div>
					</div>
				{/each}
					<div class="clear"></div>
				</div>
			</div>
		</div>
	</div>
</div>