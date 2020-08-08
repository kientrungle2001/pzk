<script language="javascript" src="../3rdparty/Validate/lib/jquery.js"></script>
<script src="../3rdparty/Validate/dist/jquery.validate.js"></script>

 <script>
  $().ready(function() 
  {
   $("#formEditpassword").validate(
   {
      rules: 
      {
        oldpassword: 
        {
          required: true,
          minlength: 6
        },
        newpassword: 
        {
          required: true,
          minlength: 6
        },
        renewpassword: 
        {
          required: true,
          equalTo: "#newpassword"
        }
      },
      messages:
       {
          oldpassword: 
          {
             required: "Mật khẩu cũ không được bỏ trống",
             minlength: "Mật khẩu tối thiểu 6 ký tự"
          },

           newpassword: 
          {
             required: "Mật khẩu mới không được bỏ trống",
             minlength: "Mật khẩu tối thiểu là 6 ký tự"
          },
           renewpassword: 
          {
             required: "Nhập lại mật khẩu mới",
              equalTo: "Nhập lại mật khẩu mới"
          }
        }
    });
  });

  </script>
<style>
      label{
          
          width: 200px;
      }
      input {
          margin-bottom: 10px;
      }
      #formEditpassword label.error {
        
        width: auto;
        display: block;
        color: red;
        font-style: italic;
        font-size: 12px;
        font-weight: normal;
       padding-left:200px;
    }
    </style>

    <div style="border-width: 1px;border-style: solid; border-color: #FF7357;  width:80%; ">
    <div> 
    <p align="center"><strong> Thay đổi mật khẩu</strong></p>
    </div> 
    <form method="post" id="formEditpassword" action="/User/changePasswordPost" >
    
      <?php 
        echo @$data->get('error');
       $request = pzk_request();
       ?>
     <br> 
     <p>Để thay đổi mật khẩu bạn vui lòng điền đầy đủ các thông tin bên dưới</p>
      <label for="oldpassword">Mật khẩu cũ:</label>
      <input type="password" name="oldpassword" id="oldpassword" value="<?php echo $request->get('oldpassword') ;  ?>">
      
      <br>

    
      <label for="newpassword">Mật khẩu mới:</label>
      <input type="password" name="newpassword" id="newpassword" value="<?php echo $request->get('newpassword') ;  ?>">
      
      <br>
      <label for="renewpassword">Xác nhận mật khẩu mới:</label>
      <input type="password" name="renewpassword" id="renewpassword" value="">
      
      <br>
    <label for="">&nbsp;</label>
      <button type="submit" class="changePassword-button">Đồng ý</button>
   
  </form>
  </div>