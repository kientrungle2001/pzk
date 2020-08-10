<script language="javascript" src="../3rdparty/Validate/lib/jquery.js"></script>
<script src="../3rdparty/Validate/dist/jquery.validate.js"></script>

 <script>
  
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
      
    }
    </style>

    <div class="addinfor">
    <div class="layout_title">  THAY ĐỔI MẬT KHẨU </div>
    <div> 
    <div class="clearfix"></div>
    <form method="post" id="formEditpass" onsubmit="pzk_<?php echo @$data->id?>.frmEditpass();return false;" >
    
     <p style="padding-left:10px;" class="message_note">Để thay đổi mật khẩu bạn vui lòng điền đầy đủ các thông tin bên dưới</p>
     
    <div class="clearfix" id="mass_editpass"></div>
    <div class="col-xs-4 col-xs-offset-2 margin-top-10" style="margin-left:0px !important;">
      <label for="oldpassword">Mật khẩu cũ (*):</label>
      <input type="password" class="form-control" id="oldpassword" name="oldpassword" placeholder="Mật khẩu cũ" data-toggle="tooltip" data-placement="top" title="Mật khẩu phải tối thiểu 6 ký tự"/>
    </div>
     
    <div class="col-xs-4 col-xs-offset-2 margin-top-10" style="margin-left:0px !important;">
      <label for="newpassword">Mật khẩu mới (*):</label>
      <input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="Mật khẩu mới" data-toggle="tooltip" data-placement="top" title="Mật khẩu phải tối thiểu 6 ký tự"/>
    </div>
     <div class="clearfix" style="padding-bottom:10px;"></div>
    <div class="col-xs-4 col-xs-offset-2 margin-top-10" style="margin-left:0px !important;">
      <label for="confirmpassword">Xác nhận mật khẩu mới (*):</label>
      <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Nhập lại mật khẩu mới" data-toggle="tooltip" data-placement="top" title="Nhập lại mật khẩu"/>
    </div>
    <div class="clearfix" style="padding-bottom:10px;"></div>
      <div class="col-xs-2 margin-top-33 " style="margin-top: 10px;" >
      <button type="submit"  class="btn btn-primary">Cập Nhật</button>
    </div>
  </form>
  </div>
  </div>