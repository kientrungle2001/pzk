
   
    <div class="show_message_active"> 
    <?php 
    	if($data->get('username') !="")
    	{

    	
     ?>
    		<p align="center" style="color:green;"><strong>Bạn đã thay đổi mật khẩu thành công  </strong></p>
    <?php 
    	}else
    	{
    ?>
    		<p align="center" style="color: red;"><strong>Thay đổi mật khẩu thất bại </strong></p>
    <?php } ?>
    </div> 

   