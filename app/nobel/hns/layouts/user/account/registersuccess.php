    
    {?
    $message= $data->get('message');
	if($message=='ok')
	{

     ?}

    <div class="show_message_active"> 
    <p align="center"><strong>Bạn đã đăng ký tài khoản thành công trên websie
    {? echo "http://".$_SERVER["SERVER_NAME"]; ?}
   </strong></p>
    </div> 
	{?  }else { ?}
	<div class="show_error"> 
    <p align="center"><strong>Kích hoạt tài khoản thất bại. Bạn vui lòng kiểm tra lại link kích hoạt hoặc gửi email đến địa chỉ NextNobels để được trợ giúp
   </strong></p>
    </div> 

	{? } ?} 
   