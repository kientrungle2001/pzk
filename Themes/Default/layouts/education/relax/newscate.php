<?php  
$cateId = $data->getParentId();
$items = $data->getNewsByCateId($cateId); 
if($items) {
?>
<?php foreach($items as $item): ?>
<div class="item bdbot bot20 pdbottom20">
	<div class="col-md-4 col-xs-4">
		<a onclick='chitiet(<?php echo @$item['id']?>); return false;' href="">
			<img src="<?=$item['img'];?>" class="img-responsive thumnail whimg"/>
		</a>
	</div>
	<div class="col-md-8 col-xs-8 ">
		<h4><a onclick='chitiet(<?php echo @$item['id']?>); return false;' href=""><?php echo @$item['title']?></a></h4>
		<?php $str = explode('=====', $item['content']);?>
		<p><?php if(isset($str[2])){ echo strip_tags(cut_words($str[2]), 50);} ?></p>
		<button class='btn btn-success' onclick='chitiet(<?php echo @$item['id']?>); return false;'>Detail</button>
	</div>
</div>
<?php endforeach; ?>
<?php } ?>

