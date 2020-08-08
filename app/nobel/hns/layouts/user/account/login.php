<?php
    if(pzk_session()->getLogin()){

?>
<?php } else{   
?>
<script language="javascript" src="../3rdparty/Validate/lib/jquery.js"></script>
<script src="../3rdparty/Validate/dist/jquery.validate.js"></script>

    <div id="formLogin">
    <div> 
    <p align="center"><strong> Đăng Nhập</strong></p>
    </div> 
    <form method="post"  action="/Account/loginPost" >
    
      <?php 
      
       echo @$data->getError();
       $request = pzk_request();
       ?>
     <br> 
      <label for="login">Tên đăng nhập:</label>
      <input type="text" name="login" id="login"size="4" value="">
      <a href="/account/register">Tạo tài khoản mới</a>
      <br>

    
      <label for="passwordlogin">Mật khẩu:</label>
      <input type="password" name="passwordlogin" id="passwordlogin" size="15px" value="">
      <a href="/account/forgotpassword">Quên mật khẩu</a>
      <br>

     <input type="checkbox" class="rememberpassword"  name="rememberpassword">    
      <label style="float:left;"for="agree">Nhớ tên truy cập</label>
     <br>
      <button type="submit" name="submitlogin" class="login-button">Đăng nhập</button>
   
  </form>
  </div>
  <?php 
}
  ?>