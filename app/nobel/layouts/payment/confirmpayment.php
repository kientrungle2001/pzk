
    <div style="border-width: 1px;border-style: solid; border-color: #FF7357;  width:80%; ">
    <?php if($data->getMessage()==1){ ?>
    <div> 
    <p align="center"><strong>Bạn vừa nạp vào tài khoản số tiền : <?php echo $data->getAmount(); ?>
   </strong></p>
    </div> 
	<?php }elseif($data->getMessage()==2){ ?>
	<div> 
    <p align="center"><strong>Chúng tôi đã nạp tiền cho giao dịch này. Vui lòng không refresh lại trang web. Cảm ơn!
   </strong></p>
    </div>
    <?php } ?> 
    </div>