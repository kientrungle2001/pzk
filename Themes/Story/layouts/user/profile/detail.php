<?php 
  $user=_db()->getEntity('User.Account.User');
  $userId= pzk_session('userId');
  $user=$user->loadByUserId($userId);
 ?>
<div class="container user"></div>
<div class="container">
	<h4 class="text-center">Thông tin cá nhân</h4>
	<div class="row top20">
		<div class="co-md-4 col-xs-4 avatar">
			<img src="<?php  echo $user->getavatar();?>" alt="trang cá nhân" class="img-circle center-block" style="width:120px; height:120px;">
			<button type="button" class="btn btn-default sharp btn-custom center-block top10" onclick="$('.profile-edit-area').show(); $('.profile-detail-area').hide(); $(window).scrollTop(900); return false;">Đổi avatar</button>
		</div>
		<div class="co-md-8 col-xs-8">
			<div class="profile-detail-area">
				<ul class="list-unstyled">
					<li><strong>Họ và tên:</strong> <?php echo $user->getName()?></li>
					<li><strong>Nick name:</strong> <?php echo $user->getUsername()?></li>
					<li><strong>Ngày sinh:</strong> <?php echo $user->getBirthDate()?></li>
					<li><strong>Giới tính:</strong> <?php echo $user->getGender()?></li>
					<li><strong>Địa chỉ:</strong> <?php echo $user->getaddress()?></li>
					<li><strong>Trường:</strong> <?php echo $user->getSchool()?></li>
					<li><strong>Lớp:</strong> <?php echo $user->getClass()?></li>
					<li><strong>Thành phố:</strong> <?php  echo $user->getCity()->getName(); ?></li>
				</ul>
				<div class="btncon top20 bottom20">
					<button type="button" class="btn btn-primary sharp" onclick="$('.profile-edit-area').show(); $('.profile-detail-area').hide(); return false;">Sửa thông tin</button>
				</div>
			</div>
			<div class="profile-edit-area" style="display: none;">
			<?php $data->displayChildren('all') ?>
			</div>
		</div>
	</div>
</div>