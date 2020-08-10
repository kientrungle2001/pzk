<?php  $items = $data->getItems(); ?>
<?php foreach($items as $item): ?>
<div class="item bdbot bot20 pdbottom20">
	<div class="col-md-4 col-sm-4 col-xs-12">
		<a onclick='chitiet(<?php echo @$item['id']?>); return false;' href="">
			<img src="<?=$item['img'];?>" class="img-responsive thumnail whimg"/>
		</a>
	</div>
	<div class="col-md-8 col-sm-8 col-xs-12 ">
		<h4><a onclick='chitiet(<?php echo @$item['id']?>); return false;' href=""><?php echo @$item['title']?></a></h4>
		<?php $str = explode('=====', $item['content']);?>
		<p><?php if(isset($str[2])){ echo cut_words(strip_tags($str[2]), 50);} ?></p>
		<button class='btn btn-success' onclick='chitiet(<?php echo @$item['id']?>); return false;'>Detail</button>
	</div>
</div>
<?php endforeach; ?>


