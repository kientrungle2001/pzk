<?php 
$title = pzk_or(@$data->getTitle(), 'Đăng ký<br />nhận tư vấn');
$title = str_replace('|', '<br />', $title);
$class = '';
if(@$data->featured) {
	$class = 'featured-box';
}
$type = $data->getType();
?>
<div class="row box support-subscribe-box">
	<div class="<?php echo $class ?>">
	</div>
    <div class="box-inner col-xs-12">
	<h3 class="text-center text-uppercase font-large color-white bgcolor1-bold padding-10"><?php echo $title ?></h3>
	<div class="box-content border-purple">
	<form class="form" method="post"  action="/support/subscribe" >
		<input type="hidden" name="type" value="<?php echo $type ?>" />
	<?php echo @$data->getError(); ?>
	   <div class="form-group">
			<input class="form-control" placeholder="Họ và tên" type="text" name="name" value="">
		</div>
		<div class="form-group">
			<input class="form-control" placeholder="Số điện thoại" type="text" name="phone" value="">
		</div>
		<div class="form-group">
			<input class="form-control" placeholder="Địa chỉ Email" type="text" name="email" value="">
		</div>
		<div class="form-group">
			<input class="form-control" placeholder="Lớp" type="text" name="class" value="">
		</div>
      <div class="text-center">
	  <button type="submit" class="btn btn-danger color-white text-uppercase font-small">Gửi đăng ký</button>
	  <a class="btn btn-success font-smaller" onclick="window.location='http://tiengviettieuhoc.vn/xem-thu-bai-giang-bai-tap-de-thi-trong-phan-mem'; return false;" class="font-smaller" href="#">Xem thử Phần mềm</a>
	  
	  </div>
	  
	</form>
	</div>
	</div>
</div>