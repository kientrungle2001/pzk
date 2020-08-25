    
    <?php 
    $message= $data->getMessage();
	if($message=='ok')
	{

     ?>

    <div class="show_message_active"> 
    <p align="center"><strong>Bạn đã đăng ký tài khoản thành công trên websie
    <?php  echo "http://".$_SERVER["SERVER_NAME"]; ?>
   </strong></p>
    </div> 
	<?php   }else { ?>
	<div class="show_error"> 
    <p align="center"><strong>Kích hoạt tài khoản thất bại. Bạn vui lòng kiểm tra lại link kích hoạt hoặc gửi email đến địa chỉ NextNobels để được trợ giúp
   </strong></p>
    </div> 

	<?php  } ?> 
   