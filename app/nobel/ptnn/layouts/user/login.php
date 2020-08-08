<?php
    if(pzk_session('login')){

    
   ?>
    
   <?php } else{

    
    
    ?>
   
    <head>
 
  <link rel="stylesheet" media="screen" href="screen.css">
  <style>
      label 
      {
        width:200px;
      }
      input {
          margin-bottom: 10px;
      }
    </style>
  <script language="javascript" src="../3rdparty/Validate/lib/jquery.js"></script>
<script src="../3rdparty/Validate/dist/jquery.validate.js"></script>

  <style>
 
    #formLogin label.error {
        
        width: auto;
        display: block;
        color: red;
        font-style: italic;
        font-size: 12px;
        font-weight: normal;
       padding-left:200px;
    }
    </style>
</head>
    <div style="border-width: 1px;border-style: solid; border-color: #FF7357;  width:80%; ">
    <div> 
    <p align="center"><strong> Đăng Nhập</strong></p>
    </div> 
    <form method="post" id="formLogin" action="/User/loginPost" >
    
      <?php 
      
       echo @$data->getError();
       $request = pzk_request();
       ?>
     <br> 
      <label for="login">Tên đăng nhập:</label>
      <input type="text" name="login" id="login"size="4" value="">
      <a href="/user/register">Tạo tài khoản mới</a>
      <br>

    
      <label for="passwordlogin">Mật khẩu:</label>
      <input type="password" name="passwordlogin" id="passwordlogin" size="15px" value="">
      <a href="/user/forgotpassword">Quên mật khẩu</a>
      <br>

     <input style="float:left;height: 18px;width:18px;padding-left:20px;" type="checkbox" class="checkbox"  name="rememberpassword">    
                                    <label style="float:left;"for="agree">Nhớ tên truy cập</label>
      <button type="submit" name="submitlogin" class="login-button">Đăng nhập</button>
   
  </form>
  </div>
  <?php 
}
  ?>