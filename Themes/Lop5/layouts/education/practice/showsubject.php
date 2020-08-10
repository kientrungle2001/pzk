<?php  $items = $data->getItems(); ?>
<?php foreach($items as $item): ?>
<div class="col-lg-2 col-md-2 col-xs-6 pd-40">
	<a href="/practice/class-<?php echo pzk_or(pzk_session('lop'), 5); ?>/subject-<?php echo @$item['alias']?>-<?php echo @$item['id']?>" class="subjectclick">
		<div class="thumbnail fxheight btn-custom3 text-color text-uppercase weight-12 text-center sharp">
			<div class="fiximg hidden-xs">
			<img src="<?=BASE_SKIN_URL?><?php echo @$item['img']?>" alt="<?php echo @$item['alias']?>" class=" img-responsive center-block">
			</div>
			<div class="hfix">
			<p class="pd-50"><?php echo @$item['name']?></p>
			<p><?php echo @$item['viettitle']?></p>
			</div>
		</div>
	</a>
</div>
<?php endforeach; ?>