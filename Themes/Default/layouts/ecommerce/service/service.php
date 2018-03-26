<div class="row">
	<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12">
		<p><strong>Bước 2: Mua gói xem đề và đáp án thi thử đợt 1, 2 </strong></p>
		<ul>
			<li>Bạn có thể dùng số tiền trong tài khoản để mua dịch vụ </li>
			<li>Bạn có thể nạp nhiều lần sao cho số tiền tương ứng để đủ để có thể mua được dịch vụ </li>
			<li>Bạn hãy click để lựa chọn xem đề và đáp án thi thử đợt 1/ thi thử đợt 2 :</li>
		</ul>
	</div>
		 <?php 
			$service	= _db()->getEntity('Service.Service');
			$items  =  $service->loadServiceTest();
		  ?>
		  
	<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12">
		{each $items as $item}
				<input type="radio" name="serviceId" id="serviceId"  checked value="{? echo $item->get('id') ?}"><strong> {? echo $item->get('serviceName') ?} </strong> Giá : <strong>{? echo product_price($item->get('amount')) ?}</strong> <br>
				<p></p>
		  {/each}
	</div>
	<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12 top10"> 
		<button class="btn btn-success" id="bttService" onclick="BuyService()">Mua</button>
	</div>
	<div class="clear-fix"></div>
	<div  class=" col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12 top10 show_error"><h4 id="show_result_service"></h4> </div>
	<h4></h4>
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
      	$.ajax({
	        url:'/service/BuyServiceTest',
	        data: {
	          serviceId:serviceId
	          
	        },
	        success: function(result)
	        {

	          	
	            if(result==0){
	            $('#show_result_service').html('<span class="label label-danger"><span class="glyphicon glyphicon-remove-sign"></span><span >Số tiền trong tài khoản của bạn không đủ để mua gói dịch vụ này. Bạn vui lòng nạp thêm tiền </span></span>');
	            
	          }else{
	          	var res	= result.split('/');
	            $('#show_result_service').html('<span class="label label-success"><span class="glyphicon glyphicon-ok-sign"></span>Bạn vừa mua thành công gói '+res[0]+'</span>');
	            
	            $('#wallet_money').html(res[1]);
	           }
	        }
        });
	}
</script>