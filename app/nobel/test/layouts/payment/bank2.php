<div style="background: none;" class="bank">
	<?php if(pzk_request()->getSegment(3) == 1 or pzk_request()->getSegment(3) == 48):?>
  <!--<div class="row">
    <h2 class="title-practice" style="margin-bottom: 30px;">HƯỚNG DẪN MUA TÀI KHOẢN HỌC</h2>
  </div>
  -->
  <style>
	#contain-left img{width:100%; margin:0px}
  </style>
	<img src="<?=BASE_URL?>/Default/skin/nobel/media/huongdan.jpg"/>
  <!--<div class="bank_area">
    
    <div class="pm_change">
      <span class="txt_bank_title" style="color: green;" > Bước 1. Bạn đăng ký tài khoản đăng nhập của mình <a id="nextnobelsLogin" href="javascript:void(0)" class="login_required" rel="/payment/bank" data-toggle="modal" data-target=".bs-example-modal-lg"><span class="pd-left-10"> TẠI ĐÂY</span></a> </span> <br>
      <span class="txt_bank_title" style="color: green;" > Bước 2. Bạn có thể mua tài khoản theo 2 cách : </span> <br>
      <br>
      <span class="txt_bank_title" > 1. Nộp tiền trực tiếp tại văn phòng </span> <br>
      <span class="pm_change_detail" style="color: green; font-weight: bold;">(<?php  echo pzk_config('name_office')?>)</span>
       <br> <br>

      <span class="pm_change1">Địa chỉ : </span>
      <span class="pm_change_detail"><?php  echo pzk_config('address_office')?></span>
      <br>

      <span class="pm_change1">Số điện thoại : </span>
      <span class="pm_change_detail"><?php  echo pzk_config('phone_office')?></span>
      <br>

      <span class="pm_change1">Ghi chú : </span>
      <span class="pm_change_detail"><?php  echo pzk_config('note_office')?></span>
      <br>
    </div>
    <div class="pm_change">
    <span class="txt_bank_title"> 2. Chuyển khoản ngân hàng</span> <br>
    <span class="pm_change1" style="color: green;">1. Ngân hàng  <?php  echo pzk_config('bank_name1')?> </span>
    
    <br>
    <span class="pm_change1">Số tài khoản: </span>
    <span class="pm_change_detail"><?php  echo pzk_config('bank_number1')?></span>
    <br>
    <span class="pm_change1">Chủ tài khoản: </span>
    <span class="pm_change_detail"><?php  echo pzk_config('bank_user1')?></span>
    <br>
    <span class="pm_change1">Ngân hàng: </span>
    <span class="pm_change_detail"><?php  echo pzk_config('bank_name1')?></span>
    <br>
    <span class="pm_change1">Chi nhánh: </span>
    <span class="pm_change_detail"><?php  echo pzk_config('bank_place1')?></span>
    <br>
    <span class="pm_change1">Nội dung: </span>
    <span class="pm_change_detail"><?php  echo pzk_config('bank_content1')?></span>
    <br>
    <br>
    
    <span class="pm_change1" style="color: green;">2. Ngân hàng  <?php  echo pzk_config('bank_name2')?> </span>
    
    <br>
    <span class="pm_change1">Số tài khoản: </span>
    <span class="pm_change_detail"><?php  echo pzk_config('bank_number2')?></span>
    <br>
    <span class="pm_change1">Chủ tài khoản: </span>
    <span class="pm_change_detail"><?php  echo pzk_config('bank_user2')?></span>
    <br>
    <span class="pm_change1">Ngân hàng: </span>
    <span class="pm_change_detail"><?php  echo pzk_config('bank_name2')?></span>
    <br>
    <span class="pm_change1">Chi nhánh: </span>
    <span class="pm_change_detail"><?php  echo pzk_config('bank_place2')?></span>
    <br>
    <span class="pm_change1">Nội dung: </span>
    <span class="pm_change_detail"><?php  echo pzk_config('bank_content2')?></span>
    <br>
    <br>
    
    <span class="pm_change1" style="color: green;">3. Ngân hàng  <?php  echo pzk_config('bank_name3')?> </span>
    
    <br>
    <span class="pm_change1">Số tài khoản: </span>
    <span class="pm_change_detail"><?php  echo pzk_config('bank_number3')?></span>
    <br>
    <span class="pm_change1">Chủ tài khoản: </span>
    <span class="pm_change_detail"><?php  echo pzk_config('bank_user3')?></span>
    <br>
    <span class="pm_change1">Ngân hàng: </span>
    <span class="pm_change_detail"><?php  echo pzk_config('bank_name3')?></span>
    <br>
    <span class="pm_change1">Chi nhánh: </span>
    <span class="pm_change_detail"><?php  echo pzk_config('bank_place3')?></span>
    <br>
    <span class="pm_change1">Nội dung: </span>
    <span class="pm_change_detail"><?php  echo pzk_config('bank_content3')?></span>
    <br>
    <br>
    
    <span class="pm_change1" style="color: green;">4. Ngân hàng  <?php  echo pzk_config('bank_name4')?> </span>
    
    <br>
    <span class="pm_change1">Số tài khoản: </span>
    <span class="pm_change_detail"><?php  echo pzk_config('bank_number4')?></span>
    <br>
    <span class="pm_change1">Chủ tài khoản: </span>
    <span class="pm_change_detail"><?php  echo pzk_config('bank_user4')?></span>
    <br>
    <span class="pm_change1">Ngân hàng: </span>
    <span class="pm_change_detail"><?php  echo pzk_config('bank_name4')?></span>
    <br>
    <span class="pm_change1">Chi nhánh: </span>
    <span class="pm_change_detail"><?php  echo pzk_config('bank_place4')?></span>
    <br>
    <span class="pm_change1">Nội dung: </span>
    <span class="pm_change_detail"><?php  echo pzk_config('bank_content4')?></span>
    <br>
    <br>
    
    <span class="pm_change1" style="color: green;">5. Ngân hàng  <?php  echo pzk_config('bank_name5')?> </span>
    
    <br>
    <span class="pm_change1">Số tài khoản: </span>
    <span class="pm_change_detail"><?php  echo pzk_config('bank_number5')?></span>
    <br>
    <span class="pm_change1">Chủ tài khoản: </span>
    <span class="pm_change_detail"><?php  echo pzk_config('bank_user5')?></span>
    <br>
    <span class="pm_change1">Ngân hàng: </span>
    <span class="pm_change_detail"><?php  echo pzk_config('bank_name5')?></span>
    <br>
    <span class="pm_change1">Chi nhánh: </span>
    <span class="pm_change_detail"><?php  echo pzk_config('bank_place5')?></span>
    <br>
    <span class="pm_change1">Nội dung: </span>
    <span class="pm_change_detail"><?php  echo pzk_config('bank_content5')?></span>
    <br>
  </div>
  </div>
  -->

  
  <?php elseif(pzk_request()->getSegment(3) == 2 ):?>
	<div class="col-xs-12">
		<div class="bank_area">
			<div class="col-xs-12">
				<h2 class="title-practice" style="margin-bottom: 30px;">Phần mềm khảo sát Toán - Tiếng Việt sắp có mặt tại Việt Nam</h2>
			</div>
			
			<div class="col-xs-12">
			
			
				<div class="pm_change text-center">
					<span class="txt_bank_title" style="color: green;" > Mọi chi tiết xin liên hệ: </span> <br>
			  <span class="txt_bank_title" style="color: green;" > Công ty Cổ phần Giáo dục Phát triển Trí tuệ và Sáng tạo Next Nobels </span> <br>
			  <br>
					<p>Trụ sở: Nhà số 6 Ngõ 115 Nguyễn Khang, Quận Cầu Giấy, Hà Nội</p>
					<p>Website: www.nextnobels.com</p>
					<p>Điện thoại liên hệ: 04.8585.2525 </p>
					 <p>Hotline: 0936.738.986</p>
				</div>
			</div>
		</div>
	</div>
  <?php endif;?>
</div>
