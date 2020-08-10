<div class="item service">
	<?php echo pzk_config('site_payment_service')?>
	 <?php 
		$service  		=  	$data->loadService();
		$couponDiscount = 	pzk_session()->get('discount');
		$discount		= 	$data->loadDiscount();
		$coupon 		=	pzk_session('coupon');
	  ?>
	<div class="col-md-10 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12 select_service hidden">
		<h5><strong>Nhập mã giảm giá(nếu có) :</strong></h5>
		<form>
			<input type="hidden" name="tab8" value="1" /> 
			<input type="text" name="coupon" value="<?php echo $coupon ?>" /> 
			<button class="btn btn-primary">Gửi</button>
		</form>
	</div>
	<div class="col-md-10 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12 select_service hidden">
		<h5><strong>Hãy chọn lớp học :</strong></h5>
		<input type="radio" name="className"  value="3">Lớp 3
		<input type="radio" name="className" class="left10" value="4">Lớp 4
		<input type="radio" name="className" class="left10" checked value="5">Lớp 5
	</div>

	<div class="col-md-10 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12 select_service">
		<h5><strong>Hãy chọn gói sản phẩm :</strong></h5>
		<?php 
			$first = true;
            foreach ($service as $item) {
              $price = $item['amount'];
			  $discountPercent = pzk_or($couponDiscount, @$discount[$item['id']]['discount']);
              $price = $item['amount'] - $item['amount'] * $discountPercent /100;
        ?>

		
			<input type="radio" name="serviceId" <?php if($first):?>checked<?php $first = false; endif;?> value="<?php echo @$item['id']?>/<?php echo $price ?>"><strong><?php echo @$item['serviceName']?></strong> Giá : <strong><?= product_price($price);?><?php  if($discountPercent):?> <span>Giá gốc: <?php  echo product_price($item['amount']); ?></span> <?php  endif;?></strong> 
		<?php 
              if($discountPercent){
                echo '<span class="label label-warning" style="font-size: 14px;">Giảm giá : '.$discountPercent.'% Chỉ còn : '.product_price($price). ' </span>';
              }
            echo '<br>';
        }
        ?>
		
	</div>
	<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12 top20 "> 
		<button class="btn btn-success" id="bttService" onclick="BuyService()">MUA</button>
	</div>
	<div class="clear-fix"></div>
	<div  class=" col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12 top10 show_error">
		<h3 class="text-center" id="show_result_service"></h3> 
	</div>
</div>

<script>
	// check radio
	/*function check(rdoName) {

	    var rdo = document.getElementsByName("rdoName");
	    var count = 0;
	    
	    for(var i=0; i < rdo.length; i++){
	       if(rdo[i].checked == true) {
	          count = count +1; }
	    }
	    return count;  
	}*/
	
	// buy service
	function BuyService(){
		var user= "<?php echo pzk_session('username'); ?>";
		if(user==''){
			alert('Bạn phải đăng nhập mới được mua');
			return false;
		}
				
				
	    var serviceId= $('.select_service input[name="serviceId"]:checked').val();
	    var className= $('.select_service input[name="className"]:checked').val();
	    
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
	        url:'/Service/BuyServiceTest',
	        data: {
	          serviceId : serviceId, 
			  coupon: '<?= pzk_session()->get('coupon');?>',
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
<style>
	.show_error{margin-left: 0px !important;}
</style>