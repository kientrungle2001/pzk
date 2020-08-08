
    <div style="border-width: 1px;border-style: solid; border-color: #FF7357;  width:80%; ">
    <?php 
    	if(pzk_session()->getUsername() !="")
    	{

     ?>

    <div> 
    <p align="center"><strong>Bạn đã đăng ký tài khoản thành công trên websie
    <?php echo "http://".$_SERVER["SERVER_NAME"]; ?>
   </strong></p>
    </div> 
	<?php 
	 }else {
			
	 ?>
	<div> 
    <p align="center"><strong>Kích hoạt tài khoản thất bại. Bạn vui lòng kiểm tra lại link kích hoạt hoặc gửi email đến địa chỉ NextNobels để được trợ giúp
   </strong></p>
    </div> 

	<?php } ?> 
    </div>