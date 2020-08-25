<?php 
$userId = pzk_session('userId');
$user = _db()->getEntity('User.Account.User');
$user->load($userId);
$birthday= $user->getBirthday(); 
if($birthday !='0000-00-00'){
	$arr= explode("/",$birthday);

}else{
	$arr= explode("/",'Ngày/Tháng/Năm');
}
$areas= $user->loadArea();
?>
<div class="profile-edit">
  <h1>Thay đổi thông tin cá nhân</h1>
  <div class="edit-area">
    <form id="profile-edit-form" class="register form-horizontal margin-top-20" method="post">
			<div class="form-group margin-top-10">
				
				<div class="col-xs-8 margin-top-10">
					
					<div id="mass_editinfor"></div>
					
				</div>
				<div class="clearfix"></div>
				<div class="col-xs-4 margin-top-10">
					<label for="username">Họ và Tên(*) :</label>
					<input type="text" class="form-control" id="editinfor_name" name="editinfor_name" value="<?php echo $user->getName()?>" placeholder="Họ và Tên" data-toggle="tooltip" data-placement="top" title="Họ và Tên">
				</div>
				
				
				<div class="col-xs-2 margin-top-10">
					<label for="sex">Giới tính :</label>
					<select  class="form-control" id="editinfor_sex" name="editinfor_sex" data-toggle="tooltip" data-placement="top" title="Lựa chọn giới tính">
						<option value="1" class="pd-5">Nam</option>
						<option value="0" class="pd-5">Nữ</option>
					</select>
					<script type="text/javascript">
						$('#editinfor_sex').val('<?php echo $user->getSex()?>');
					</script>
				</div>
				<div class="col-xs-3 margin-top-10">
					<label for="phone">Điện thoại (*) :</label>
					<input type="text" class="form-control" id="editinfor_phone" name="editinfor_phone" value="<?php echo $user->getPhone()?>" placeholder="Điện thoại" data-toggle="tooltip" data-placement="top" title="Điện thoại phải là số">
				</div>
				<div class="clearfix" style="padding-bottom:10px;"></div>
				<div class="col-xs-4 margin-top-10">
					<label for="username">Địa chỉ :</label>
					<input type="text" class="form-control" id="editinfor_address" name="editinfor_address" value="<?php echo $user->getaddress()?>" placeholder="Địa chỉ" data-toggle="tooltip" data-placement="top" title="Địa chỉ của bạn">
				</div>
				<div class="col-xs-8 margin-top-10">
					<label for="username">Ngày sinh (*) :</label>
					<div class="clear"></div>
						<div class="col-xs-2" style="padding-left: 0px; padding-right: 0px; margin: auto; margin-right: 25px;">
		<select id="editinfor_day" class="form-control" title="Ngày" name="birthday_day" aria-label="Ngày" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
		
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
						<div class="col-xs-2" style="padding-left: 0px; padding-right: 0px; margin-right: 25px; ">
	  <select id="editinfor_month" class="form-control col-xs-4" style="padding-left:5px;" title="Tháng" name="birthday_month" aria-label="Tháng" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
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
						<div class="col-xs-2" style="padding-left: 0px; padding-right: 0px; ">
	  <select id="editinfor_year" class="form-control col-xs-4" title="Năm" name="birthday_year" aria-label="Năm" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
		<option selected="1"><?php echo @$arr[2]; ?></option>
		<?php
		$y = date("Y");
		for($i = $y; $i > 1905; $i--):?>
		<option value="<?=$i;?>"><?=$i;?></option>
		<?php endfor;?>
	  </select>
	</div>
						<input type="hidden" id="editinfor_birthday" class="birthday" name="birthday" value=""/>
				</div>

				<div class="clearfix"></div>
				<div class="col-xs-4 margin-top-10">
					<label for="school">Trường :</label>
					<input type="text" class="form-control" id="editinfor_school" name="editinfor_school" value="<?php echo $user->getSchool()?>" placeholder="Trường học" data-toggle="tooltip" data-placement="top" title="Trường học">
				</div>                            
			   
				<div class="col-xs-2 margin-top-10">
					<label for="class">Lớp học :</label>
					<input type="text" class="form-control" id="editinfor_class" name="editinfor_class" value="<?php echo $user->getClass()?>" placeholder="Lớp học" data-toggle="tooltip" data-placement="top" title="Lớp học">
				</div> 

				<div class="col-xs-3 margin-top-10">
					<label for="area">Tỉnh/TP :</label>
					<select  class="form-control" id="editinfor_areacode" title="Tỉnh/ Thành phố" name="editinfor_areacode" aria-label="Tỉnh/tp" data-toggle="tooltip" data-placement="top" title="Tỉnh/ Thành phố">
								<?php foreach($areas as $area): ?>
								<option value="<?php echo $area['id']; ?>"><?php   echo $area['name']; ?></option>
								<?php endforeach; ?>
					</select>
					<script type="text/javascript">
					$('#editinfor_areacode').val('<?php echo $user->getareacode()?>');
					</script>
				</div>

				 <div class="clearfix"></div>
				<div class="col-xs-2 margin-top-33 " style="margin-top: 10px;" >
					<button type="submit" id="editinfor_Button" class="btt_update">Cập Nhật</button>
				</div>
			</div>
		</form>
  </div>
</div>