    <style>
      label{
          float: left;
          width: 200px;
      }
      input {
          margin-bottom: 10px;
      }
    </style>
    <?php 
      if($data->get('username') !="")
      {


     ?>
    <div style="width:100%; ">
    <div> 

    <p align="center" style="color:green;"><strong>Tài khoản và mật khẩu của bạn</strong></p>
    </div> 
    Tài khoản của bạn là: <?php echo $data->get('username');?><br />
      Mật khẩu là: <?php echo $data->get('password');?><br />
    </div>
    <?php 
      }else{
     ?>  
     <div style="width:100%; ">
     <p align="center" style="color:red;"><strong>Xác nhận mật khẩu mới thất bại!</strong></p>
     <p align="center">Bạn hãy kiểm tra lại đường dẫn kích hoạt hoặc gửi mail đến ... để được trợ giúp.</p>
     </div> 
    <?php 
       }
     ?>
