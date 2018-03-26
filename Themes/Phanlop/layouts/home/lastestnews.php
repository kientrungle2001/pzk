<div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12 text-justify top20">
	<div class="col-md-12 col-sm-12 col-xs-12 top20 text-justify" id="chitiet">
		{children [position=hotnews]}
	</div>
	<p><strong>Các tin khác</strong></p>
	<?php  $items = $data->getListFLSN(); ?>
	{each $items as $item}
	<div class="item bot20 pdbottom20">
		<div class="col-md-4 col-sm-4 col-xs-12">
			<a onclick='chitiet({item[id]}); return false;' href="">
				<img src="<?=$item['img'];?>" class="img-responsive thumnail whimg"/>
			</a>
		</div>
		<div class="col-md-8 col-sm-8 col-xs-12">
			<h4><a onclick='chitiet({item[id]}); return false;' href="">{item[title]}</a></h4>
			<?php $str = explode('=====', $item['content']);?>
			<p><?php if(isset($str[2])){ echo strip_tags(cut_words($str[2]), 50);} ?></p>
		</div>
	</div>
	{/each}
	<script>
	function chitiet(id){
	$("#chitiet").load(BASE_REQUEST + "/relax/ajaxdetail?id="+id);
	}
	</script>
</div>