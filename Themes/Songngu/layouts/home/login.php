<?php $data->displayChildren('[position=public-header]') ?>
<?php $data->displayChildren('[position=top-menu]') ?>
<?php 
$rel = "/home/index";
$message = 'Bạn phải <a rel="<?=$rel;?>" class="login_head" data-toggle="modal" data-target="#LoginModal" style="cursor:pointer;">Đăng nhập</a>';
if($data->getMessage()) $message = $data->getMessage();
if($data->getRel()) {
	$rel = $data->getRel();
}
?>
<div class="container ">
	<div class='alert alert-danger'>
	<h3 class="pd-top-15 h3tb"><?php echo $message ?></h3>
	</div>
</div>