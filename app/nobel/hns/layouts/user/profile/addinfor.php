
<script src="/3rdparty/Validate/dist/jquery.validate.js"></script>
<script src="/js/loadding.js"></script>
 <script>
 $(document).ready(function () {
         $("#formAddinfor").validate({
            rules: {

                add_username: {
                    required: true,
                    minlength: 5,
                    username:true

                },

                add_password: {
                    required: true,
                    minlength: 6,
                    password:true
                },
                add_email: {
                    required: true,
                    email: true
                },
                add_day:{
                    required: true,
                    min:1,
                    max:31
                },
                add_month:{
                    required: true,
                    min:1,
                    max:12
                },
                add_year:{
                    required: true,
                    min:1905,
                },
                add_phone:{
                    required: true

                }
            },
            messages: {

                add_username: {
                    required: "Yêu cầu nhập tên đăng nhập",
                    minlength: "Tên đăng nhập tối thiểu phải 6 ký tự",
                    username:" Tên đăng nhập chưa đúng"

                },
                add_password: {
                    required:   "Yêu cầu nhập mật khẩu đầy đủ",
                    minlength:  "Mật khẩu tối thiểu phải 6 ký tự ",
                    password:   "Mật khẩu chưa phù hợp"
                },
                add_email: "Email chưa đúng định dạng",
                add_day:"",
                add_month:"",
                badd_year:"",
                add_phone:""

            }
        });
     });
</script>
<style>

</style>
<div class="user_editinfor1">
  <div class="title_edit">Bổ xung thông tin tài khoản</div>  
  <div class="edit_area">
    <div class="clearfix" style="padding-bottom:20px;"></div>
    <div id="mass_addinfor"></div>
    <div class="clearfix" style="padding-bottom:10px;"></div>
    <form id="formAddinfor" class="register form-horizontal margin-top-20" onsubmit="frmAddinfor(); return false;"  method="post">
                            <div class="form-group margin-top-10">

                                <div class="col-xs-4 margin-top-10">
                                    <label for="username">Tên đăng nhập (*) :</label>
                                    <input type="text" class="form-control" id="add_username" name="add_username" placeholder="Tên đăng nhập" data-toggle="tooltip" data-placement="top" title="Tên đăng nhập tối thiểu phải 6 ký tự, không có ký tự đặc biệt">
                                </div>
                                <div class="col-xs-5 margin-top-10">
                                    <label for="email">Email (*) :</label>
                                    <input type="text" class="form-control" id="add_email" name="add_email" placeholder="Email" data-toggle="tooltip" data-placement="top" title="Email của bạn">
                                </div>


                                <div class="clearfix" style="padding-bottom:10px;"></div>
                                <div class="col-xs-4 col-xs-offset-2 margin-top-10" style="margin-left:0px !important;">
                                    <label for="password1">Mật khẩu (*):</label>
                                    <input type="password" class="form-control" id="add_password" name="add_password" placeholder="Mật khẩu" data-toggle="tooltip" data-placement="top" title="Mật khẩu gồm cả chữ cái và chữ số, ít nhất 1 chữ viết hoa, 1 chữ viết thường, 1 số và không chứa khoảng trắng"/>
                                </div>

                                <div class="col-xs-8 margin-top-10">
                                    <label for="username">Ngày sinh (*) :</label>
                                    <div class="clear"></div>
						    			<div class="col-xs-2" style="padding-left: 0px; padding-right: 0px; margin-right: 25px;">
								    		<select id="add_day" class="form-control" title="Ngày" name="birthday_day" aria-label="Ngày" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
												<?php 
                          $birthday= $data->get('birthday'); 
                          if($birthday !='0000-00-00'){
                            $arr= explode("/",$birthday);

                          }else{
                            $arr= explode("/",'Ngày/Tháng/Năm');
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
										<div class="col-xs-2" style="padding-left: 0px; padding-right: 0px; margin-right: 25px; ">
											<select id="add_month" class="form-control col-xs-4" style="padding-left:5px;" title="Tháng" name="birthday_month" aria-label="Tháng" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
												<option selected="1"><?=$arr[1]; ?></option>
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
											<select id="add_year" class="form-control col-xs-4" title="Năm" name="birthday_year" aria-label="Năm" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
												<option selected="1"><?=$arr[2]; ?></option>
												<?php
												$y = date("Y");
												for($i = $y; $i > 1905; $i--):?>
												<option value="<?=$i;?>"><?=$i;?></option>
												<?php endfor;?>
											</select>
										</div>
										<input type="hidden" id="add_birthday" class="birthday" name="birthday" value=""/>
                                </div>


                                <div class="clearfix"></div>
                                <div class="col-xs-4 margin-top-10">
                                    <label for="username">Địa chỉ :</label>
                                    <input type="text" class="form-control" id="add_address" name="add_address" placeholder="Địa chỉ" data-toggle="tooltip" data-placement="top" title=" Địa chỉ của bạn" >
                                </div>
                                <div class="col-xs-2 margin-top-10">
                                    <label for="sex">Giới tính</label>
                                    <select  class="form-control" id="add_sex" name="add_sex" data-toggle="tooltip" data-placement="top" title="Lựa chọn giới tính">
                                        <option value="1" class="pd-5">Nam</option>
                                        <option value="0" class="pd-5">Nữ</option>
                                    </select>
                                </div>
                                <div class="col-xs-3 margin-top-10">
                                    <label for="phone">Điện thoại (*) :</label>
                                    <input type="text" class="form-control" id="add_phone" name="add_phone" value="" placeholder="Điện thoại" data-toggle="tooltip" data-placement="top" title="Điện thoại phải là số">
                                </div>

                                <div class="clearfix"></div>
                                <div class="col-xs-4 margin-top-10">
                                    <label for="school">Trường :</label>
                                    <input type="text" class="form-control" id="add_school" name="add_school" value="" placeholder="Trường học" data-toggle="tooltip" data-placement="top" title="Trường học">
                                </div>

                                <div class="col-xs-2 margin-top-10">
                                    <label for="phone">Lớp :</label>
                                    <input type="text" class="form-control" id="add_class" name="add_class" value="" placeholder="Lớp học" data-toggle="tooltip" data-placement="top" title="Lớp học">
                                </div>


                                <div class="col-xs-3 margin-top-10">
                                    <label for="area">Tỉnh/TP :</label>
                                    <select  class="form-control" title="Tỉnh/ Thành phố" id="add_areacode" name="add_areacode" aria-label="Tỉnh/tp" data-toggle="tooltip" data-placement="top" title="Tỉnh/ Thành phố">
                                                <?php
                                                    $areacode=_db()->getEntity('User.Account.User');
                                                    $areas= $areacode->loadArea();
                                                ?>
                                                {each $areas as $area}
                                                <option value="<?php echo $area['id']; ?>"><?php   echo $area['name']; ?></option>
                                                {/each}

                                    </select>
                                </div>
                                <div class="col-xs-8 margin-top-10">
                                    <label for="username"></label>
                                    <div class="show_ok"><span><?php echo $data->get('message'); ?></span></div>
                                    <div class="show_error"><span><?php echo $data->get('error'); ?></span></div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-xs-2 margin-top-33 " style="margin-top: 10px;" >
                                    <button type="submit" id="add_Button"  class="btt_update">Cập Nhật</button>
                                </div>
                            </div>
                        </form>
  </div>
</div>
<script>

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
	function set_birthday(){
		var day 	= $("#add_day").val();
		var month 	= $("#add_month").val();
		var year 	= $("#add_year").val();

		var birthday = day+'/'+month+'/'+year;
		$("#add_birthday").val(birthday);

	}
  function frmAddinfor(){
    var erroremail = $('#add_email-error').text();
   	var errorusername = $('#add_username-error').text();
   	var errorpassword = $('#add_password-error').text();
   	var errorbirthday = $('#add_birthday-error').text();
   	var errorname = $('#add_email-error').text();
   	var errorphone = $('#add_phone-error').text();
   	if(erroremail !=''||errorusername !=''||errorpassword !=''||errorbirthday !=''||errorphone !=''){
   		return false;
   	}else{
   		set_birthday();
   		var email=$("#add_email").val();
		var username=$("#add_username").val();
		var password=$("#add_password").val();
		var birthday=$("#add_birthday").val();
		var phone=$("#add_phone").val();
		var address=$("#add_address").val();
		var sex=$("#add_sex").val();
		var school=$("#add_school").val();
		var class1=$("#add_class").val();
		var area=$("#add_areacode").val();
		if(email ==''||username ==''||password ==''||birthday ==''||phone ==''){
			return false;
		}else{
			$.ajax({
      			type: "Post",
      			data:{
          			email: email,
          			username: username,
          			password: password,
          			birthday: birthday,
          			phone: phone,
          			school: school,
          			class1: class1,
          			area: area,
          			address: address,
          			sex: sex
      			},
      			url:'/profile/addinforPost',
      			success: function(msg){

            		if(msg=='1'){
                		$('#mass_addinfor').html('<p align="center" style="color:green;"><strong><span class="glyphicon glyphicon-ok"></span>  Bạn đã cập nhật thông tin thành công!  </strong></p>');
            		}else if(msg=='01'){
                		$('#mass_addinfor').html('<p align="center" style="color:red;"><strong><span class="glyphicon glyphicon-remove"></span>  Tên đăng nhập đã tồn tại trên hệ thống, bạn vui lòng chọn tên đăng nhập khác!  </strong></p>');
                   	}else if(msg=='02'){
                    	$('#mass_addinfor').html('<p align="center" style="color:red;"><strong><span class="glyphicon glyphicon-remove"></span>  Email đã tồn tại trên hệ thống, bạn vui lòng chọn email khác!  </strong></p>');

                    }


      			}
    });
		}
   	}
  }
  /* jQuery(document).ajaxStart(function () {
      //show ajax indicator
    ajaxindicatorstart('Xin vui lòng đợi trong giây lát','formAddinfor');
  }).ajaxStop(function () {
    //hide ajax indicator
    ajaxindicatorstop('formAddinfor');
  }); */
</script>