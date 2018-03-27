
    <div class="payment" style="float: left; margin-top: 10px;">
    <?php if($data->getMessage()==1){ ?>
    <div style="color: green;"> 
        <span class="glyphicon glyphicon-ok"></span><span><strong>Bạn vừa nạp vào tài khoản số tiền : <?php echo $data->getAmount(); ?></strong></span>
    </div> 
	<?php }elseif($data->getMessage()==2){ ?>
	<div style="color: red;">
        <span  class="glyphicon glyphicon-remove"></span><span> <strong>Chúng tôi đã nạp tiền cho giao dịch này. Vui lòng không refresh lại trang web. Cảm ơn!</strong></span>
    </div>
    <?php } ?> 
    </div>