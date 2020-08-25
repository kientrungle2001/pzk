<?php 
$userId = pzk_session('userId');
$user = _db()->getEntity('User.Account.User');
$user->load($userId, 300);
$birthday= $user->getBirthday(); 
if($birthday !='0000-00-00'){
	$arr= preg_split("/[\/-]/",$birthday);
	if(strpos($birthday, '-') !== false) {
		$arr = array_reverse($arr);
	}

}else{
	$arr= explode("/",'Ngày/Tháng/Năm');
}
$areas= $user->loadArea();
?>
<div class="container-fluid">
	<div class="row">
		<form id="profile-edit-form" action="" method="POST" class="form-horizontal" role="form">
				<div class="form-group">
					<legend>Thông tin cá nhân</legend>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-4 top10">
							<label for="username">Họ và Tên(*) : </label>
							<input  id="editinfor_name" name="editinfor_name" type="text" class="form-control sharp"  
									value="<?php echo $user->getName()?>" placeholder="Họ và Tên" title="Họ và Tên"
									data-toggle="tooltip" data-placement="top" />
						</div>
						
						
						<div class="col-md-3  top10">
							<label for="sex">Giới tính : </label>
							<select id="editinfor_sex" name="editinfor_sex" class="form-control sharp"   
									data-toggle="tooltip" data-placement="top" title="Lựa chọn giới tính">
								<option value="1" class="pd-5">Nam</option>
								<option value="0" class="pd-5">Nữ</option>
							</select>
							<script type="text/javascript">
								$('#editinfor_sex').val('<?php echo $user->getSex()?>');
							</script>
						</div>
						<div class="col-md-3  top10">
							<label for="phone">Điện thoại (*) :</label>
							<input id="editinfor_phone" name="editinfor_phone" type="text" class="form-control sharp" 
									value="<?php echo $user->getPhone()?>" placeholder="Điện thoại" title="Điện thoại phải là số" 
									data-toggle="tooltip" data-placement="top" />
						</div>
					</div>
					<div class="row">
						<div class="col-md-4  top10">
							<label for="username">Địa chỉ : </label>
							<input id="editinfor_address" name="editinfor_address" type="text" class="form-control sharp" 
									value="<?php echo $user->getaddress()?>" data-toggle="tooltip" data-placement="top" 
									placeholder="Địa chỉ"  title="Địa chỉ của bạn">
						</div>
						<div class="col-md-8 top10" style="padding-left: 0px;">
							<div class="col-md-12">
								<label for="username">Ngày sinh (*) : </label>
							</div>
							<div class="col-md-3 col-sm-4 col-xs-4">
								<select id="editinfor_day" class="form-control sharp" title="Ngày" name="birthday_day" aria-label="Ngày" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
							
								<option selected="1"><?=$arr[0]; ?></option>
								  	<?php for($d = 1; $d <=31; $d++):?>
									  <?php if($d < 10){ ?>
										<option value="<?php echo '0'.$d;?>"><?php echo '0'.$d;?></option>
									  <?php }else{ ?>
										<option value="<?=$d;?>"><?=$d;?></option>
									  <?php } ?>
									<?php endfor;?>
							  	</select>
							</div>
						
							<div class="col-md-3 col-sm-4 col-xs-4">
							
							  <select id="editinfor_month" class="form-control col-xs-4 sharp"  title="Tháng" name="birthday_month" aria-label="Tháng" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
								<option selected="1"><?php echo @$arr[1]; ?></option>
								  <?php for($m = 1; $m <= 12; $m++):?>
								  <?php if($m< 10){ ?>
									<option value="<?php echo '0'.$m;?>"><?php echo '0'.$m?></option>
								  <?php }else{ ?>
									<option value="<?=$m;?>"><?=$m?></option>
								  <?php } ?>
								<?php endfor;?>
							  </select>
							</div>
							<div class="col-md-3 col-sm-4 col-xs-4">
								
							  	<select id="editinfor_year" class="form-control col-xs-4 sharp" title="Năm" name="birthday_year" aria-label="Năm" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
									<option selected="1"><?php echo @$arr[2]; ?></option>
									<?php
									$y = date("Y");
									for($i = $y; $i > 1905; $i--):?>
									<option value="<?=$i;?>"><?=$i;?></option>
									<?php endfor;?>
							  	</select>
							</div>
						</div>
						<input type="hidden" id="editinfor_birthday" class="birthday" name="birthday" value=""/>
						
					</div>
					



				</div>
				
		
				<div class="form-group">
					<button type="submit" id="editinfor_Button" class="btn btn-primary sharp">Cập Nhật</button>
					<button type="button" id="cancel_edit_button" class="btn sharp" onclick="$('.profile-edit-area').hide(); $('.profile-detail-area').show(); return false;">Hủy</button>
				</div>
		</form>
	</div>
</div>
