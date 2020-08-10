
<script src="../3rdparty/Validate/dist/jquery.validate.js"></script>
<script src="/js/loadding.js"></script>
 <script>
 
</script>
<style>
      label{
          
          width: 200px;
      }
      input {
          margin-bottom: 10px;
      }
      #formEditinfor label.error {
        
        width: auto;
        display: block;
        color: red;
        font-style: italic;
        font-size: 12px;
        font-weight: normal;
      
    }
    </style>
<?php 
  //$user= $data->loadInfor(pzk_session()->getUserId());
  //var_dump($user);die;
  $user = pzk_user();
 ?>

<div class="addinfor">
  <div class="layout_title">Thay đổi các thông tin cá nhân</div>	
  <div class="edit_area">
    <form id="formEditinfor" class="register form-horizontal margin-top-20" method="post" onsubmit="pzk_<?php echo @$data->id?>.frmEditinfor(); return false; ">
                            <div class="form-group margin-top-10">
                                <div class="clearfix"></div>
                                <div class="col-xs-8 margin-top-10">
                                    
                                    <div id="mass_editinfor"></div>
                                    
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-xs-4 margin-top-10">
                                    <label for="username">Họ và Tên(*) :</label>
                                    <input type="text" class="form-control" id="editinfor_name" name="editinfor_name" value=" <?php echo $user->getName();?>" placeholder="Họ và Tên" data-toggle="tooltip" data-placement="top" title="Họ và Tên">
                                </div>
                                
                                
                                <div class="col-xs-2 margin-top-10">
                                    <label for="sex">Giới tính :</label>
                                    <select  class="form-control" id="editinfor_sex" name="editinfor_sex" data-toggle="tooltip" data-placement="top" title="Lựa chọn giới tính">
                                        <option value="1" class="pd-5">Nam</option>
                                        <option value="0" class="pd-5">Nữ</option>
                                    </select>
                                </div>
                                <div class="col-xs-3 margin-top-10">
                                    <label for="phone">Điện thoại (*) :</label>
                                    <input type="text" class="form-control" id="editinfor_phone" name="editinfor_phone" value=" <?php echo $user->getPhone();?>" placeholder="Điện thoại" data-toggle="tooltip" data-placement="top" title="Điện thoại phải là số">
                                </div>
                                <div class="clearfix" style="padding-bottom:10px;"></div>
                                <div class="col-xs-4 margin-top-10">
                                    <label for="username">Địa chỉ :</label>
                                    <input type="text" class="form-control" id="editinfor_address" name="editinfor_address" value="<?php echo $user->getAddress();?>" placeholder="Địa chỉ" data-toggle="tooltip" data-placement="top" title="Địa chỉ của bạn">
                                </div>
                                <div class="col-xs-8 margin-top-10">
                                    <label for="username">Ngày sinh (*) :</label>
                                    <div class="clear"></div>
						    			<div class="col-xs-2" style="padding-left: 0px; padding-right: 0px; margin: auto; margin-right: 28px;">
                        <select id="editinfor_day" class="form-control" title="Ngày" name="birthday_day" aria-label="Ngày" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
                        <?php 
                        	$birthday= $user->getBirthday(); 
                        	if($birthday !=''){
                        		$arr= explode("-",$birthday);

                        	}else{
                        		$arr= explode("-",'Ngày-Tháng-Năm');
                        	}
                        	
                        ?>
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
										<div class="col-xs-2" style="padding-left: 0px; padding-right: 10px; margin-right: 33px; ">
                      <select id="editinfor_month" class="form-control col-xs-4" style="padding-left:5px;width: 107px;" title="Tháng" name="birthday_month" aria-label="Tháng" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
                        <option selected="1"><?=$arr[1]; ?></option>
                          <?php for($m = 1; $m <= 12; $m++):?>
                          <?php if($m< 10){ ?>
                            <option value="<?php echo '0'.$m;?>"><?php echo 'Tháng '.$m?></option>
                          <?php }else{ ?>
                            <option value="<?=$m;?>">Tháng <?=$m?></option>
                          <?php } ?>
                        <?php endfor;?>
                      </select>
                    </div>
										<div class="col-xs-2" style="padding-left: 0px; padding-right: 0px; ">
                      <select id="editinfor_year" class="form-control col-xs-4" title="Năm" name="birthday_year" aria-label="Năm" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
                        <option selected="1"><?=$arr[2]; ?></option>
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
                                    <input type="text" class="form-control" id="editinfor_school" name="editinfor_school" value=" <?php echo $user->getSchool();?>" placeholder="Trường học" data-toggle="tooltip" data-placement="top" title="Trường học">
                                </div>                            
                               
                                <div class="col-xs-2 margin-top-10">
                                    <label for="class">Lớp học :</label>
                                    <input type="text" class="form-control" id="editinfor_class" name="editinfor_class" value=" <?php echo $user->getClass();?>" placeholder="Lớp học" data-toggle="tooltip" data-placement="top" title="Lớp học">
                                </div> 
                                <?php
                                  $areas= $user->loadArea();
                                  
                                ?>
                                <div class="col-xs-3 margin-top-10">
                                    <label for="area">Tỉnh/TP :</label>
                                    <select  class="form-control" id="editinfor_areacode" title="Tỉnh/ Thành phố" name="editinfor_areacode" aria-label="Tỉnh/tp" data-toggle="tooltip" data-placement="top" title="Tỉnh/ Thành phố" >
                                       <option selected="1" value="{user.getareacode()}"><?php echo $user->loadByAreacode($user->getAreacode()); ?></option>
                                                
                                                <?php foreach($areas as $area): ?>
                                                <option value="<?php echo $area['id']; ?>"><?php   echo $area['name']; ?></option>
                                                <?php endforeach; ?>
                                            
                                    </select>
                                </div>

                                 <div class="clearfix"></div>
                                <div class="col-xs-2 margin-top-33 " style="margin-top: 10px;" >
                                    <button type="submit" id="editinfor_Button" class="btn btn-primary">Cập Nhật</button>
                                </div>
                            </div>
                        </form>
  </div>
</div>
