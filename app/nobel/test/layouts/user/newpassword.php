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
      if($data->getUsername() !="")
      {


     ?>
    <div style="border-width: 1px;border-style: solid; border-color: #FF7357;  width:80%; ">
    <div> 

    <p align="center"><strong>Tài khoản và mật khẩu của bạn</strong></p>
    </div> 
    Tài khoản của bạn là: <?php echo $data->getUsername();?><br />
      Mật khẩu là: <?php echo $data->getPassword();?><br />
    </div>
    <?php 
      }else{
     ?>  
     <div style="border-width: 1px;border-style: solid; border-color: #FF7357;  width:80%; ">
     <p align="center"><strong>Xác nhận mật khẩu mới thất bại!</strong>
        Bạn hãy kiểm tra lại đường dẫn kích hoạt hoặc gửi mail đến ... để được trợ giúp.</p>
     </div> 
    <?php 
       }
     ?>
