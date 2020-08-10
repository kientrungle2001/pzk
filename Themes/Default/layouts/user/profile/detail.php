<?php 
  $user=_db()->getEntity('User.Account.User');
  $userId= pzk_session('userId');
  $user=$user->loadByUserId($userId);
  $payment=_db()->getEntity('Payment.History_payment');
  $date= $payment->getDateFL();
  
 ?>
<div class="container user">
	<div class="row">
		<div class="col-md-1">&nbsp;</div>			
		<div class="col-xs-11 col-md-11">
			<div class="pd-90 text-right">
				<h1><a href="<?=FL_URL?>">FULL LOOK</a></h1>
				<h3 class="hidden-xs">Phần mềm Khảo sát và Phát triển năng lực toàn diện bằng tiếng Anh</h3>				
				<?php echo partial('Themes/Default/layouts/home/aboutbtn');?>
			</div>
		</div>
	</div>
</div>
<?php $data->displayChildren('[position=top-menu]') ?>
<div class="container">
	<div class="row">
		<div class="col-md-4 col-sm-4 col-xs-4"></div>
		<div class="co-md-8 col-sm-8 col-xs-12">
			<h3>THÔNG TIN CÁ NHÂN</h3>
		</div>
		
	</div>
	<div class="row top20">
		<div class="col-md-4 col-sm-4 col-xs-4 avatar">
			<img src="<?php  echo $user->get('avatar');?>" alt="trang cá nhân" class="img-circle center-block" style="width:120px; height:120px;">
			<button type="button" class="btn btn-primary sharp  center-block top10" onclick="$('.profile-edit-area').show(); $('.profile-detail-area').hide(); $(window).scrollTop(900); return false;">Đổi avatar</button>
		</div>
		<div class="co-md-8 col-sm-8 col-xs-12">
			<div class="profile-detail-area">
				
				<ul class="list-unstyled">
					<li><strong>Họ và tên:</strong> <?php echo $user->get('name')?></li>
					<li><strong>Nick name:</strong> <?php echo $user->get('username')?></li>
					<li><strong>Ngày sinh:</strong> <?php echo $user->get('birthDate')?></li>
					<li><strong>Giới tính:</strong> {user.getGender()}</li>
					<li><strong>Địa chỉ:</strong> <?php echo $user->get('address')?></li>
					<li><strong>Trường:</strong> <?php echo $user->get('schoolname')?></li>
					<li><strong>Lớp:</strong> <?php echo $user->get('classname')?></li>
					<li><strong>Thành phố:</strong> <?php  echo $user->getCity()->get('name'); ?></li>
					<?php if(pzk_session('checkPayment')) :?>						
					<li><strong>Thời hạn sản phẩm 1 năm (<?php echo $date ?>)</strong></li>
					<?php endif;?>
				</ul>
				
				
				<div class="btncon top20 bottom20">
					<button type="button" class="btn btn-primary sharp" onclick="$('.profile-edit-area').show(); $('.profile-detail-area').hide(); return false;">Sửa thông tin</button>
				</div>
			</div>
			<div class="profile-edit-area" style="display: none;">
			<?php $data->displayChildren('[position=profile-edit-area]') ?>
			</div>
		</div>
	</div>
</div>