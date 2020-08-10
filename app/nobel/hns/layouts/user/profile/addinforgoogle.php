<script src="/js/loadding.js"></script>
<script src="/3rdparty/Validate/dist/jquery.validate.js"></script>
 <script>
 $(document).ready(function () {
         $("#formAddinforG").validate({
            rules: {
                
                addg_username: {
                    required: true,
                    minlength: 5,
                    username:true
                   
                },
                
                addg_password: {
                    required: true,
                    minlength: 6,
                    password:true
                },
                addg_day:{
                    required: true
                },
                addg_month:{
                    required: true
                },
                addg_year:{
                    required: true,
                    min:1905
                },
                addg_phone:{
                    required: true,
                    number:true
                }
            },
            messages: {
                
                addg_username: {
                    required: "Yêu cầu nhập tên đăng nhập",
                    minlength: "Tên đăng nhập tối thiểu phải 6 ký tự",
                    username:" Tên đăng nhập chưa đúng"
                    
                },
                addg_password: {
                    required:   "Yêu cầu nhập mật khẩu đầy đủ",
                    minlength:  "Mật khẩu tối thiểu phải 6 ký tự ",
                    password:   "Mật khẩu chưa phù hợp"
                },
                addg_email: "Email chưa đúng định dạng",
                addg_day:"Yêu cầu nhập ngày sinh",
                addg_month:"Yêu cầu nhập tháng sinh",
                addg_year:"Yêu cầu nhập năm sinh",
                addg_phone:" Yêu cầu nhập số điện thoại"
                
            }
        });
     });
</script>
<div class="user_editinfor1">
  <div class="title_edit">Bổ xung thông tin tài khoản</div>  
  <div class="edit_area">
    <div class="clearfix" style="margin-bottom:20px;"></div>
    <div id="mess_addinforG"></div>
        
    
    <form id="formAddinforG" class="register form-horizontal margin-top-20" onsubmit="frmAddinforG(); return false;" method="post">
                            <div class="form-group margin-top-10">
                                <div class="clearfix"></div>
                                <div class="col-xs-4 margin-top-10">
                                    <label for="username">Họ và Tên(*) :</label>
                                    <input type="text" class="form-control" id="addg_name" name="editinfor_name" value=" <?php echo $data->getName();?>" placeholder="Họ và Tên" data-toggle="tooltip" data-placement="top" title="Họ và Tên">
                                </div>
                                <div class="col-xs-5 margin-top-10">
                                    <label for="username">Tên đăng nhập (*) :</label>
                                    <input type="text" class="form-control" id="addg_username" name="addg_username" placeholder="Tên đăng nhập" data-toggle="tooltip" data-placement="top" title="Tên đăng nhập tối thiểu phải 6 ký tự, không có ký tự đặc biệt">
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-xs-4 col-xs-offset-2 margin-top-10" style="margin-left:0px !important;">
                                    <label for="password1">Mật khẩu (*):</label>
                                    <input type="password" class="form-control" id="addg_password" name="addg_password" placeholder="Mật khẩu" data-toggle="tooltip" data-placement="top" title="Mật khẩu gồm cả chữ cái và chữ số, ít nhất 1 chữ viết hoa, 1 chữ viết thường, 1 số và không chứa khoảng trắng"/>
                                </div>
                                
                                <div class="col-xs-8 margin-top-10">
                                    <label for="username">Ngày sinh (*) :</label>
                                    <div class="clear"></div>
                                        <div class="col-xs-2" style="padding-left: 0px; padding-right: 0px; margin-right: 25px;">
                                            <?php 
                                                $birthday= $data->getBirthday(); 
                                                if($birthday !='0000-00-00'){
                                                    $arr= explode("/",$birthday);

                                                }else{
                                                    $arr= explode("/",'Ngày/Tháng/Năm');
                                                }
                          
                                            ?>
                                            <select id="addg_day" class="form-control" title="Ngày" name="birthday_day" aria-label="Ngày" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
                                                <option selected="1"><?=$arr[0];?></option>
                                                <?php for($d = 1; $d <=31; $d++):?>
                                                    <?php if($d < 10){ ?>
                                                    <option value="<?php echo '0'.$d;?>"><?php echo '0'.$d;?></option>
                                                    <?php }else{ ?>
                                                    <option value="<?=$d;?>"><?=$d;?></option>
                                                    <?php } ?>
                                                <?php endfor;?>    
                                            </select>
                                        </div>
                                        <div class="col-xs-2" style="padding-left: 0px; padding-right: 0px; margin-right: 25px;">
                                            <select id="addg_month" class="form-control col-xs-4" style="padding-left:5px;" title="Tháng" name="birthday_month" aria-label="Tháng" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
                                                <option selected="1"><?=$arr[1];?></option>
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
                                            <select id="addg_year" class="form-control col-xs-4" title="Năm" name="birthday_year" aria-label="Năm" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
                                                <option selected="1"><?=$arr[2];?></option>
                                                <?php 
                                                $y = date("Y");
                                                for($i = $y; $i > 1905; $i--):?>
                                                <option value="<?=$i;?>"><?=$i;?></option>
                                                <?php endfor;?>
                                            </select>
                                        </div>
                                        <input type="hidden" id="addg_birthday" class="birthday" name="birthday" value=""/>
                                </div>

                                <div class="clearfix"></div>
                                <div class="col-xs-4 margin-top-10">
                                    <label for="username">Địa chỉ :</label>
                                    <input type="text" class="form-control" id="addg_address" name="addg_address" placeholder="Địa chỉ" data-toggle="tooltip" data-placement="top" title=" Địa chỉ của bạn" >
                                </div>
                                <div class="col-xs-2 margin-top-10">
                                    <label for="sex">Giới tính</label>
                                    <select  class="form-control" id="addg_sex" name="addg_sex" data-toggle="tooltip" data-placement="top" title="Lựa chọn giới tính">
                                        <option value="1" class="pd-5">Nam</option>
                                        <option value="0" class="pd-5">Nữ</option>
                                    </select>
                                </div>
                                <div class="col-xs-3 margin-top-10">
                                    <label for="phone">Điện thoại (*) :</label>
                                    <input type="text" class="form-control" id="addg_phone" name="addg_phone" placeholder="Điện thoại" data-toggle="tooltip" data-placement="top" title="Điện thoại phải là số">
                                </div>

                                <div class="clearfix"></div>
                                <div class="col-xs-4 margin-top-10">
                                    <label for="school">Trường :</label>
                                    <input type="text" class="form-control" id="addg_school" name="addg_school" value=" <?php echo $data->getSchool();?>" placeholder="Trường học" data-toggle="tooltip" data-placement="top" title="Trường học">
                                </div>                            
                               
                                <div class="col-xs-2 margin-top-10">
                                    <label for="phone">Lớp :</label>
                                    <input type="text" class="form-control" id="addg_class"  name="addg_class" value=" <?php echo $data->getClass();?>" placeholder="Lớp học" data-toggle="tooltip" data-placement="top" title="Lớp học">
                                </div>

                                <div class="col-xs-3 margin-top-10">
                                    <label for="area">Tỉnh/TP :</label>
                                    <select  class="form-control" title="Tỉnh/ Thành phố" id="addg_areacode" name="addg_areacode" aria-label="Tỉnh/tp" data-toggle="tooltip" data-placement="top" title="Tỉnh/ Thành phố">
                                                <?php 
                                                    $areacode=_db()->getEntity('User.Account.User');
                                                    $areas= $areacode->loadArea();
                                                ?>
                                                <?php foreach($areas as $area): ?>
                                                <option value="<?php echo $area['id']; ?>"><?php   echo $area['name']; ?></option>
                                                <?php endforeach; ?>
                                            
                                    </select>
                                </div>
                                <div class="col-xs-8 margin-top-10">
                                    <label for="username"></label>
                                    <div class="show_ok"><span><?php echo $data->getMessage(); ?></span></div>
                                    <div class="show_error"><span><?php echo $data->getError(); ?></span></div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-xs-2 margin-top-33 " style="margin-top: 10px;" >
                                    <button type="submit" id="addg_Button"  class="btt_update">Cập Nhật</button>
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
        var day     = $("#addg_day").val();
        var month   = $("#addg_month").val();
        var year    = $("#addg_year").val();

        var birthday = day+'/'+month+'/'+year;
        $("#addg_birthday").val(birthday);
        
    }
  function frmAddinforG(){
    var errorname = $('#addg_name-error').text();
    var errorusername = $('#addg_username-error').text();
    var errorpassword = $('#addg_password-error').text();
    var errorbirthday = $('#addg_birthday-error').text();
    var errorphone = $('#addg_phone-error').text();
    if(errorname !='' ||errorusername !=''||errorpassword !=''||errorbirthday !=''||errorphone !=''){
        return false;
    }else{
        set_birthday();
        var name=$("#addg_name").val();
        var username=$("#addg_username").val();
        var password=$("#addg_password").val();
        var birthday=$("#addg_birthday").val();
        var phone=$("#addg_phone").val();
        var address=$("#addg_address").val();
        var sex=$("#addg_sex").val();
        var school=$("#addg_school").val();
        var class1=$("#addg_class").val();
        var area=$("#addg_areacode").val();
        if(name ==''||username ==''||password ==''||birthday ==''||phone ==''){
            return false;
        }else{
            $.ajax({
                type: "Post",
                data:{
                    name: name,
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
                url:'/profile/addinforGPost',
                success: function(msg){
                    
                    if(msg=='1'){
                        $('#mess_addinforG').html('<p align="center" style="color:green;"><strong><span class="glyphicon glyphicon-ok"></span>  Bạn đã cập nhật thông tin thành công!  </strong></p>');
                    }else if(msg=='01'){
                        $('#mess_addinforG').html('<p align="center" style="color:red;"><strong><span class="glyphicon glyphicon-remove"></span>  Tên đăng nhập đã tồn tại trên hệ thống, bạn vui lòng chọn tên đăng nhập khác!  </strong></p>');
                    }
                }
            });
        }
    }
  }
  /* jQuery(document).ajaxStart(function () {
      //show ajax indicator
    ajaxindicatorstart('Xin vui lòng đợi trong giây lát','formAddinforG');
  }).ajaxStop(function () {
    //hide ajax indicator
    ajaxindicatorstop('formAddinforG');
  }); */
</script>                