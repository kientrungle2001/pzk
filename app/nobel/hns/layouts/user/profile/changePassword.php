

<script src="/3rdparty/Validate/dist/jquery.validate.js"></script>

<script src="/js/loadding.js"></script>


<script language="javascript" src="<?php echo BASE_URL?>/3rdparty/Validate/dist/jquery.validate.js"></script>
<script src="<?php echo BASE_URL?>/js/loadding.js"></script>

<div class="user_editinfor1">
  <div class="title_edit">Thay đổi mật khẩu</div>
  <div class="editpass_area">

    <form  id="frmeditPass" onsubmit="frmEditPass();return false;" method="post">
    <div id="mass_editpass"></div>
    <div class="col-xs-4 col-xs-offset-2 margin-top-10" style="margin-left:0px !important;">
      <label for="epass_oldpass">Mật khẩu cũ (*):</label>
      <input type="password" class="form-control" id="epass_oldpass" name="epass_oldpass" placeholder="Mật khẩu cũ" data-toggle="tooltip" data-placement="top" title="Mật khẩu gồm cả chữ cái và chữ số, ít nhất 1 chữ viết hoa, 1 chữ viết thường, 1 số và không chứa khoảng trắng"/>
    </div>
     
    <div class="col-xs-4 col-xs-offset-2 margin-top-10" style="margin-left:0px !important;">
      <label for="epass_newpass">Mật khẩu mới (*):</label>
      <input type="password" class="form-control" id="epass_newpass" name="epass_newpass" placeholder="Mật khẩu mới" data-toggle="tooltip" data-placement="top" title="Mật khẩu mới phải gồm cả chữ cái và chữ số, ít nhất 1 chữ viết hoa, 1 chữ viết thường, 1 số và không chứa khoảng trắng"/>
    </div>
     <div class="clearfix" style="padding-bottom:10px;"></div>
    <div class="col-xs-4 col-xs-offset-2 margin-top-10" style="margin-left:0px !important;">
      <label for="epass_cfrpass">Xác nhận mật khẩu mới (*):</label>
      <input type="password" class="form-control" id="epass_cfrpass" name="epass_cfrpass" placeholder="Nhập lại mật khẩu mới" data-toggle="tooltip" data-placement="top" title="Nhập lại mật khẩu"/>
    </div>
    <div class="clearfix" style="padding-bottom:10px;"></div>
      <div class="col-xs-2 margin-top-33 " style="margin-top: 10px;" >
      <button type="submit"  class="btt_update">Cập Nhật</button>
    </div>
  </form>  
  </div>
</div>
<script>

  $(function () {
      $('[data-toggle="tooltip"]').tooltip()
  });
  
  $(document).ready(function () {
      $("#frmeditPass").validate({
          rules:{
             epass_oldpass: {
                required: true,
                minlength: 6,
                password:true
              },  
            epass_newpass: {
                required: true,
                minlength: 6,
                password:true
            },
            epass_cfrpass: {
               required: true,
                equalTo: "#epass_newpass"
            }
          },
          messages: {
              epass_oldpass:  {
                 required: "Mật khẩu cũ không được bỏ trống",
                 minlength: "Mật khẩu tối thiểu 6 ký tự",
                 password: "Mật khẩu chưa đúng định dạng"
              },
        epass_newpass: {
                 required: "Mật khẩu mới không được bỏ trống",
                 minlength: "Mật khẩu tối thiểu là 6 ký tự",
                 password: "Mật khẩu chưa đúng định dạng"
              },
               epass_cfrpass: {
                equalTo: "Mật khẩu phải trùng với mật khẩu mới"
              }
         }
      });
    });

  function frmEditPass(){
   //alert(1);
   var lableoldpass = $('#epass_oldpass-error').text();
   var lablenewpass = $('#epass_newpass-error').text();
   var lablecfrpass = $('#epass_cfrpass-error').text();
   if(lableoldpass!='' || lablenewpass!='' || lablecfrpass!='' ){
     return false;
   }else{
    var oldpass = $('#epass_oldpass').val();
    var newpass = $('#epass_newpass').val();
    var cfrpass = $('#epass_cfrpass').val();
    if(oldpass=='' || newpass=='' || cfrpass=='' ){
      return false;
    }else{
    //var dataeditpass = $('#frmeditPass').serializeForm();
    $.ajax({
      type: "Post",
      data:{
          oldpass: oldpass,
          newpass: newpass,
          cfrpass: cfrpass
      },
      url:'/profile/changePassword1',
      success: function(msg){
        if(msg=='1'){
            $('#mass_editpass').html('<p align="center" style="color:green;"><strong><span class="glyphicon glyphicon-ok"></span>  Bạn vui lòng đăng nhập vào Email để kích hoạt mật khẩu mới  </strong></p>');
            $('#epass_oldpass').val('');
            $('#epass_newpass').val('');
            $('#epass_cfrpass').val('');
        }else{
          if(msg=='0'){
            $('#mass_editpass').html('<p align="center" style="color: red;"><strong><span class="glyphicon glyphicon-remove"></span>  Mật khẩu cũ chưa chính xác </strong></p>');
            $('#epass_oldpass').val('');
            $('#epass_newpass').val('');
            $('#epass_cfrpass').val('');
          }
        }
       
      }

    }); 
    }
    
   }
  }
/* jQuery(document).ajaxStart(function () {
      //show ajax indicator
    ajaxindicatorstart('Vui lòng đợi trong giây lát','frmeditPass');
  }).ajaxStop(function () {
    //hide ajax indicator
    ajaxindicatorstop('frmeditPass');
  }); */
$(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });

  

</script>
  