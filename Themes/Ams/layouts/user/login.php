<?php 
$rel = "/contest/index";
if($data->getRel()) {
	$rel = $data->getRel();
}
?>
<div class="container boder nomg contentheight linebg robotofont">
	<h3 class="pd-top-15 h3tb">Bạn phải <a rel="<?=$rel;?>" data-toggle="modal" data-target="#LoginModal" style="cursor:pointer;">Đăng nhập</a> <?php echo $data->getTitle(); ?></h3>
</div>