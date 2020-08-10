<?php 
$items 				= 	$data->getItems(); 
$items 				= 	buildTree($items);
$root 				= 	$items[0];
$children 			= 	$root['children'];
?>
<div class="lecture-region <?php echo @$root['alias']?>">
	<div class="lecture-bird-2 hidden-xs"></div>
	<div class="container">
		<h1 class="text-center"><?php echo @$root['name']?></h1>
		<div class="row columns-lecture">
			<div class="col-xs-12">
				<div class="lecture-index">
				<?php foreach($children as $section): ?>
					<div class="row">
						<div class="col-md-2 hidden-xs hidden-sm">&nbsp;</div>
						<div class="col-md-9 col-xs-12 col-sm-12">
							<center><h3 class="lecture-section-heading"><?php echo @$section['name']?></h3></center>
							<div class="row">
							<?php 	$subs 	= 	$section['children'];
								$index	=	1;
							?>
								<?php foreach($subs as $sub): ?>
								<div class="col-xs-12 col-md-6">
									<div class="lecture-item blcolor4-bold num<?php echo $index ?>">
										<div class="lecture-title color4-bold"><a href="/<?php echo @$sub['alias']?>"><?php echo @$sub['name']?></a></div>
										
										<?php for($i = 0; $i < 9; $i++):
										$j = $i;
										if($i == 0) {
											$j = '';
										}
										if(!isset($sub['video' . $j]) || !$sub['video' . $j]) continue;
										?>
										<div class="lecture-detail">
										<a href="/<?php echo @$sub['alias']?>?video=<?php echo $j ?>"><?php echo $sub['video' . $j . '_title']?></a>
										</div>
										<?php endfor;?>
										
										
										<div class="lecture-practice"><a href="/<?php echo @$sub['alias']?>">Bài tập</a></div>
									</div>
								</div>
								<?php  	$index++; ?>
								<?php endforeach; ?>
							</div>
						</div>
						<div class="col-md-1 hidden-xs hidden-sm">&nbsp;</div>
					</div>
				<?php endforeach; ?>
					<div class="clear"></div>
				</div>
			</div>
		</div>
	</div>
</div>