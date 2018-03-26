 <?php 
  /*$user=_db()->getEntity('User.Account.User');
  $userId= pzk_session('userId');
  $user=$user->load($userId, 300);*/
  
 ?>
{children [position=public-header]}
{children [position=top-menu]}
<div class="container">
	
	<div class="row top20">
		<div class="col-md-4 col-sm-4 avatar">
			<img src="<?php echo pzk_session('avatar') ?>" alt="trang cá nhân" class="img-circle center-block" style="width:120px; height:120px;">
			<button type="button" class="btn btn-default sharp btn-custom center-block top10" onclick="$('.profile-edit-area').show(); $('.profile-detail-area').hide(); $(window).scrollTop(900); return false;">Đổi avatar</button>
		</div>
		<div class="co-md-8 col-sm-8">
			<div class="profile-detail-area">
				<div class="col-md-12 col-xs-12">
					<ul class="list-unstyled">
						<li class="top10"><strong>Họ và tên : </strong> <?php echo pzk_session('name') ?></li>					
						<li class="top10"><strong>Nick name : </strong><?php echo pzk_session('username') ?></li>
						<li class="top10"><strong>Ngày sinh : </strong><?php echo pzk_session('birthday') ?></li>
						<li class="top10"><strong>Giới tính : </strong><?php echo pzk_session('sex') ?></li>
						<li class="top10"><strong>Địa chỉ : </strong><?php echo pzk_session('address') ?></li>
						<li class="top10"><strong>Trường : </strong><?php echo pzk_session('schoolname') ?></li>
						<li class="top10"><strong>Lớp: </strong><?php echo pzk_session('class'). pzk_session('classname') ?></li>
						
						
					</ul>
				</div>	
				<!--div class="col-md-9 col-xs-12">
					<img class="img-responsive" src="/Themes/Songngu3/skin/images/bannerdetail.png" />
				</div-->
				<ul class="list-unstyled item">	
					<?php if(pzk_session('checkPayment')) :?>
					
					<li class="top10"><strong>Thời hạn sản phẩm :</strong>
						<ul>
							<?php 
								$payment=_db()->getEntity('Payment.History_payment');
  								$dates= $payment->getDate();

							 ?>
							 <?php if($dates) :
							 $class = 5;
							 ?>
							 {each $dates as $item}
							 <?php
							 	echo "<li>";
							 	
							 	$paymentDate = $payment->formatDate($item['paymentDate']);
							    $expiredDate = $payment->formatDate($item['expiredDate']);
							 	
							 	if($item['languages'] == 'ev' || $item['languages'] == ''){
							 		
							 		if($item['class']){
							 			$class = $item['class'];
							 		}

							    echo "Bạn được học Song ngữ cho tất cả các môn học của lớp ".$class." (Từ ngày ".$paymentDate. " đến ".$expiredDate . ")";
								}else if($item['languages'] == 'vn'){
									echo "Bạn được học ngôn ngữ tiếng Việt cho tất cả các môn học của lớp ".$class." (Từ ngày ".$paymentDate. " đến ".$expiredDate . ")";
								}else if($item['languages'] == 'en'){
									echo "Bạn được học ngôn ngữ tiếng Anh cho tất cả các môn học của lớp ".$class." (Từ ngày ".$paymentDate. " đến ".$expiredDate . ")";
								}
							  ?>
							</li>
							{/each}
							<?php endif;?>
						</ul>
					</li>
					<?php endif;?>
				</ul>
				<div class="btncon pull-left top20 bottom20">
					<button type="button" class="btn btn-primary sharp" onclick="$('.profile-edit-area').show(); $('.profile-detail-area').hide(); return false;">Sửa thông tin</button>
				</div>
			</div>
			<div class="profile-edit-area" style="display: none;">
			{children [position=profile-edit-area]}
			</div>
		</div>
	</div>
</div>