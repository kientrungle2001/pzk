 <?php 
	$service	= 	_db()->getEntity('Service.Service');
	$items  	=  	$service->loadService();
	$discount	=	pzk_session('discount');
	$coupon		=	pzk_session('coupon');
  ?>
<div class="row">
	<div class="col-xs-12">
		<h4><strong><span class="label label-success">Bước 2 </span>: Mua Phần mềm học luyện Tiếng Việt 4 và Phát triển Ngôn ngữ</strong></h4>
		<ul>
			<li>Bạn có thể dùng số tiền trong tài khoản để mua phần mềm </li>
			<li>Bạn có thể nạp nhiều lần sao cho số tiền tương ứng đủ để có thể mua được phần mềm</li>
		</ul>
	</div>
	<div class="col-xs-12">
		<form method="get">
			Mã giảm giá:
			<input type="text" name="coupon" value="<?php echo $coupon ?>" />
			<button class="btn btn-danger">GỬI</button>
		</form>
	</div>
	<div class="col-xs-12">
		<h5><strong>Hãy chọn gói sản phẩm :</strong></h5>
		<?php foreach($items as $item): ?>
			<?php  $price = $item->getamount();
				$price = $price * (1 - $discount / 100);
			  ?>
			<input type="radio" name="serviceId" id="serviceId" checked value="<?php  echo $item->getId() ?>"><strong> <?php  echo $item->getServiceName() ?> </strong> Giá ưu đãi: <strong><?php  echo product_price($price) ?> <?php  if($discount): ?> <span>Giá gốc: <?php  echo product_price($item->getamount()); ?></span><?php  endif; ?></strong> <br>
		
		<?php endforeach; ?>
	</div>
	<div class="col-xs-12 top-20 "> 
		<button class="btn btn-danger" id="bttService" onclick="BuyService()">MUA</button>
	</div>
	<div  class=" col-xs-12 top-10 show_error">
		<h3 class="text-center" id="show_result_service"></h3> 
	</div>
	<div class="col-xs-12">
		<h4>Cần hỗ trợ trong quá trình nạp thẻ, vui lòng gọi đến số  0919.56.36.11 để được trợ giúp.</h4>
	</div>
</div>

<script>
	
	// buy service
	function BuyService(){
		var user= "<?php echo pzk_session('username'); ?>";
		if(user==''){
			alert('Bạn phải đăng nhập mới được mua');
			return false;
		}
				
				
	    var serviceId= $('input[name="serviceId"]:checked').val();
	    var className= $('input[name="className"]:checked').val();
	    
	    if(className == ''){	
	    	alert('Bạn chưa chọn lớp');    	
	    	return false;
	    }
	    if(serviceId == ''){
	    	alert('Bạn chưa chọn gói sản phẩm');
	    	return false;
	    }
	    //console.log(serviceId);
      	$.ajax({
	        url:'/Service/BuyService',
	        data: {
	          serviceId : serviceId, 
			  coupon:	'<?php echo $coupon ?>',
			  className : className
	        },
	        success: function(result)
	        {
	            if(result==0){
	            $('#show_result_service').html('<span class="label label-danger"><span class="glyphicon glyphicon-remove-sign"></span><span >Số tiền trong tài khoản của bạn không đủ để mua gói sản phẩm này. Bạn vui lòng nạp thêm tiền </span></span>');
	            $('#pm_result').html('');
	          }else{
	          	var res	= result.split('/');
	            $('#show_result_service').html('<span class="label label-success"><span class="glyphicon glyphicon-ok-sign"></span>Bạn vừa mua thành công '+res[0]+'! Vui lòng đăng nhập lại để sử dụng dịch vụ</span>');
	            $('#pm_result').html('');
	            $('#wallet_money').html(res[1]);
	           }
	        }
        });
	}
</script>