<?php $data->displayChildren('[position=public-header]') ?>
<?php $data->displayChildren('[position=top-menu]') ?>


<div class="container t-color">
	
	<div class="row">
		<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12">
			<h3 class="text-center"><?php echo $data->get('mess'); ?></h3>
			<h3 class="text-center"><span class="label label-danger"><?php echo $data->get('error'); ?></span></h3>
		</div>
	</div>
	
</div>







