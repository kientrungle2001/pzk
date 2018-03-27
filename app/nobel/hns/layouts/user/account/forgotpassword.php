
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

    <div id="forgotpassword">
    <div> 
    <p align="center"><strong> Lấy lại mật khẩu mới</strong></p>
    </div> 
    <form id="formForgotpassword" method="post" action="/Account/forgotpasswordPost" >
    
      <?php 
        echo @$data->get('error');
       $request = pzk_element('request');
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