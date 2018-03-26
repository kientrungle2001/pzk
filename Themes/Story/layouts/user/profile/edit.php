<?php 
$userId = pzk_session('userId');
$user = _db()->getEntity('User.Account.User');
$user->load($userId);
$birthday= $user->get('birthday'); 
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
<div class="profile-edit">
  <div class="edit-area">
    <form id="profile-edit-form" class="register form-horizontal margin-top-20" method="post">
		<div class="form-group top10">
			
			<div class="col-xs-8 top10">
				
				<div id="mass_editinfor"></div>
				
			</div>
			<div class="clearfix"></div>
			<div class="col-xs-4 top10">
				<label for="username">Họ và Tên(*) :</label>
				<input  id="editinfor_name" name="editinfor_name" type="text" class="form-control sharp"  
						value="{user.get('name')}" placeholder="Họ và Tên" title="Họ và Tên"
						data-toggle="tooltip" data-placement="top" />
			</div>
			
			
			<div class="col-xs-2 top10">
				<label for="sex">Giới tính :</label>
				<select id="editinfor_sex" name="editinfor_sex" class="form-control sharp"   
						data-toggle="tooltip" data-placement="top" title="Lựa chọn giới tính">
					<option value="1" class="pd-5">Nam</option>
					<option value="0" class="pd-5">Nữ</option>
				</select>
				<script type="text/javascript">
					$('#editinfor_sex').val('{user.get('sex')}');
				</script>
			</div>
			<div class="col-xs-3 top10">
				<label for="phone">Điện thoại (*) :</label>
				<input id="editinfor_phone" name="editinfor_phone" type="text" class="form-control sharp" 
						value="{user.get('phone')}" placeholder="Điện thoại" title="Điện thoại phải là số" 
						data-toggle="tooltip" data-placement="top" />
			</div>
			<div class="clearfix" style="padding-bottom:10px;"></div>
			<div class="col-xs-4 top10">
				<label for="username">Địa chỉ :</label>
				<input id="editinfor_address" name="editinfor_address" type="text" class="form-control sharp" 
						value="{user.get('address')}" data-toggle="tooltip" data-placement="top" 
						placeholder="Địa chỉ"  title="Địa chỉ của bạn">
			</div>
			<div class="col-xs-8 top10">
				<label for="username">Ngày sinh (*) :</label>
				<div class="clear"></div>
					<div class="col-xs-2" style="padding-left: 0px; padding-right: 0px; margin: auto; margin-right: 25px;">
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
					<div class="col-xs-2" style="padding-left: 0px; padding-right: 0px; margin-right: 25px; ">
					  <select id="editinfor_month" class="form-control col-xs-4 sharp" style="padding-left:5px;" title="Tháng" name="birthday_month" aria-label="Tháng" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
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
					  <select id="editinfor_year" class="form-control col-xs-4 sharp" title="Năm" name="birthday_year" aria-label="Năm" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
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
			<div class="col-xs-4 top10">
				<label for="school">Trường :</label>
				<input type="text" class="form-control sharp" id="editinfor_school" name="editinfor_school" value="{user.get('school')}" placeholder="Trường học" data-toggle="tooltip" data-placement="top" title="Trường học">
			</div>                            
		   
			<div class="col-xs-2 top10">
				<label for="class">Lớp học :</label>
				<input type="text" class="form-control sharp" id="editinfor_class" name="editinfor_class" value="{user.get('class')}" placeholder="Lớp học" data-toggle="tooltip" data-placement="top" title="Lớp học">
			</div> 

			<div class="col-xs-3 top10">
				<label for="area">Tỉnh/TP :</label>
				<select  class="form-control sharp" id="editinfor_areacode" title="Tỉnh/ Thành phố" name="editinfor_areacode" aria-label="Tỉnh/tp" data-toggle="tooltip" data-placement="top" title="Tỉnh/ Thành phố">
							{each $areas as $area}
							<option value="<?php echo $area['id']; ?>"><?php   echo $area['name']; ?></option>
							{/each}
				</select>
				<script type="text/javascript">
				$('#editinfor_areacode').val('{user.get('areacode')}');
				</script>
			</div>

			 <div class="clearfix"></div>
			<div class="col-xs-12 top10">
				<button type="submit" id="editinfor_Button" class="btn btn-primary sharp">Cập Nhật</button>
				<button type="button" id="cancel_edit_button" class="btn sharp" onclick="$('.profile-edit-area').hide(); $('.profile-detail-area').show(); return false;">Hủy</button>
			</div>
		</div>
		</form>
  </div>
</div>