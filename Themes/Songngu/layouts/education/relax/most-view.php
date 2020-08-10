<?php  $items = $data->getItems(); ?>
<?php $i = 1; ?>
<?php foreach($items as $item): ?>
<div id="myCarousel" class="carousel <?php if($i<3){ echo 'mgb9p';} ?> fix_slider" data-ride="carousel">
	<div class="carousel-inner" role="listbox">
		<div class="item active">
			<a onclick='chitiet(<?php echo @$item['id']?>); return false;' href="#"><img src="<?php echo @$item['img']?>" alt="<?php echo @$item['title']?>" class="col-md-12 col-sm-12 col-xs-12" style="max-height:100px;">
				<div class="carousel-caption">
					<?php $str = $item['title'];?>
					<?php echo cut_words($str, 4); ?>
				</div>
			</a>
		</div>
	</div>
</div>
<?php $i++; ?>
<?php endforeach; ?>
<style>
	.fix_slider{
		float:left;
		width: 50%;
		padding: 0px 2% 0px 2%;
	}
	.mgb9p{
		margin-bottom: 9%;
	}
</style>
