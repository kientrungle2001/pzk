<div class="row carousel-holder">

	<div class="col-xs-12">
		<div id="<?php echo @$data->id?>" class="carousel slide" data-ride="carousel">
			<ol class="carousel-indicators">
				<?php  foreach($data->children as $index => $child):?>
				<li data-target="#<?php echo @$data->id?>" data-slide-to="<?php echo $index ?>"></li>
				<?php  endforeach;?>
			</ol>
			<div class="carousel-inner">
			<?php  foreach($data->children as $child):?>
				<div class="item">
					<?php  $child->display(); ?>
				</div>
			<?php  endforeach;?>
			</div>
			<a class="left carousel-control" href="#<?php echo @$data->id?>" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left"></span>
			</a>
			<a class="right carousel-control" href="#<?php echo @$data->id?>" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right"></span>
			</a>
		</div>
	</div>

</div>