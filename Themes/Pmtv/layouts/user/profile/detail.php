<?php 
  $user=_db()->getEntity('User.Account.User');
  $userId= pzk_session('userId');
  $user=$user->loadByUserId($userId);
  $payment=_db()->getEntity('Payment.History_payment');
  $date= $payment->getDate();
 ?>
<div class="container">
	<div class="row">
		<div class="col-md-4 col-sm-4 col-xs-4"></div>
		<div class="co-md-8 col-sm-8 col-xs-12">
			<h3>THÔNG TIN CÁ NHÂN</h3>
		</div>
		
	</div>
	<div class="row top20">
		<div class="col-md-4 col-sm-4 col-xs-4 avatar">
			<img src="{? echo $user->get('avatar');?}" alt="trang cá nhân" class="img-circle center-block" style="width:120px; height:120px;">
			<button type="button" class="btn btn-primary sharp  center-block top10" onclick="$('.profile-edit-area').show(); $('.profile-detail-area').hide(); $(window).scrollTop(900); return false;">Đổi avatar</button>
		</div>
		<div class="co-md-8 col-sm-8 col-xs-12">
			<div class="profile-detail-area">
				<ul class="list-unstyled">
					<li><strong>Họ và tên:</strong> {user.get('name')}</li>
					<li><strong>Nick name:</strong> {user.get('username')}</li>
					<li><strong>Ngày sinh:</strong> {user.get('birthDate')}</li>
					<li><strong>Giới tính:</strong> {user.getGender()}</li>
					<li><strong>Địa chỉ:</strong> {user.get('address')}</li>
					<li><strong>Trường:</strong> {user.get('school')}</li>
					<li><strong>Lớp:</strong> {user.get('class')}</li>
					<li><strong>Thành phố:</strong> {? echo $user->getCity()->get('name'); ?}</li>
					<?php if(pzk_user()->checkPayment('lecture')) :?>
					<li class="top10"><strong>Thời hạn sản phẩm :</strong>
						<ul>
							<?php 
								$payment=_db()->getEntity('Payment.History_payment');
  								$dates= $payment->getDate('lecture');

							 ?>
							 <?php if($dates) :?>
							 {each $dates as $item}
							 <?php
							 	echo "<li>";
							 	
							 	$paymentDate = $payment->formatDate($item['paymentDate']);
							    $expiredDate = $payment->formatDate($item['expiredDate']);
							    echo "Bạn được học phần mềm (Từ ngày ".$paymentDate. " đến ".$expiredDate . ")";
							  ?>
							</li>
							{/each}
							<?php endif;?>
						</ul>
					</li>
					<?php endif;?>
				</ul>
				<div class="btncon top20 bottom20">
					<button type="button" class="btn btn-primary sharp" onclick="$('.profile-edit-area').show(); $('.profile-detail-area').hide(); return false;">Sửa thông tin</button>
				</div>
			</div>
			<div class="profile-edit-area" style="display: none;">
			{children [position=profile-edit-area]}
			</div>
		</div>
	</div>
</div>