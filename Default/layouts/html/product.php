<div class="col-sm-4 col-lg-4 col-md-4">
		<div class="thumbnail">
			<img src="<?php echo @$data->image?>" alt="">
			<div class="caption">
				<h4 class="pull-right">$<?php echo @$data->price?></h4>
				<h4><a href="<?php echo @$data->link?>"><?php echo @$data->name?></a>
				</h4>
				<p><?php echo @$data->brief?></p>
			</div>
			<div class="ratings">
				<p class="pull-right"><?php echo @$data->reviews?> reviews</p>
				<p>
					<span class="glyphicon glyphicon-star"></span>
					<span class="glyphicon glyphicon-star"></span>
					<span class="glyphicon glyphicon-star"></span>
					<span class="glyphicon glyphicon-star"></span>
					<span class="glyphicon glyphicon-star"></span>
				</p>
			</div>
		</div>
	</div>