
<script language="javascript" src="../3rdparty/Validate/lib/jquery.js"></script>
<script src="../3rdparty/Validate/dist/jquery.validate.js"></script>
<script>
 
  $().ready(function() 
  {
   $("#formForgotpassword").validate(
   {
      rules: 
      {
        email: 
        {
          required: true,
          email: true
        },
        captcha: "required"
      },
      messages:
       {
          email: 
          {
             required: "Yêu cầu nhập email",
             email: "Email chưa đúng định dạng"
          },

           captcha: "Mã bảo mật không được bở trống"     
        }
        });
    });
</script>
   <style>
 
    #formForgotpassword label.error {
        
        width: auto;
        display: block;
        color: red;
        font-style: italic;
        font-size: 12px;
        font-weight: normal;
       padding-left:200px;
    }
 

      label{
          
          width: 200px;
          
      }
      input {
          margin-bottom: 10px;
      }
    </style>
    <div style="border-width: 1px;border-style: solid; border-color: #FF7357;  width:80%; height: auto;">
    <div> 
    <p align="center"><strong> Lấy lại mật khẩu mới</strong></p>
    </div> 
    <form id="formForgotpassword" method="post" action="/User/forgotpasswordPost" >
    
      <?php 
        echo @$data->get('error');
       $request = pzk_request();
       ?>
     <br> 
     <p>Bạn hãy điền địa chỉ email của bạn vào ô bên dưới, một mật khẩu mới sẽ được gửi đến mail của bạn, sau khi xác nhận mật khẩu mới thành công bạn có thể đăng nhập vào bình thường.</p>
      <label for="email">Email:</label>
      <input type="text" name="email" id="email" value="<?php echo $request->get('email') ;  ?>">
      
      <br>

    
      <label for="captcha">Mã bảo mật:</label>
      
      <input type="captcha" name="captcha" id="captcha" value="">
      <img src="<?php echo "http://".$_SERVER["SERVER_NAME"]."/3rdparty/captcha/random_image.php";  ?>" />
      
      <br>
    <label for="">&nbsp;</label>
      <button name="ok" type="submit" class="login-button">Đồng ý</button>
   
  </form>
  </div>