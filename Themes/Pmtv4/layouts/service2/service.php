<div class="row">
	<div class="col-xs-12">
		<h4 class="text-uppercase"><strong><span class="label label-success">Bước 2 </span>: Mua gói dịch vụ</strong></h4>
		<ul>
			<li>Bạn có thể dùng số tiền trong tài khoản để mua gói dịch vụ</li>
			<li>Bạn có thể nạp nhiều lần sao cho số tiền tương ứng đủ để có thể mua được gói dịch vụ</li>
		</ul>
	</div>
	 <?php 
		$service	= _db()->getEntity('Service.Service');
		$items  =  $service->loadService();
	  ?>
	<div class="col-xs-12">
		<h5><strong>Hãy chọn lớp học :</strong></h5>
		<input type="radio" name="className"  value="3">Lớp 3
		<input type="radio" name="className" class="left10" value="4">Lớp 4
		<input type="radio" name="className" class="left10" checked value="5">Lớp 5
	</div>
	<div class="col-xs-12">
		<h5><strong>Hãy chọn gói sản phẩm :</strong></h5>
		<?php foreach($items as $item): ?>
		
			<input type="radio" name="serviceId" id="serviceId" checked value="<?php  echo $item->getId() ?>"><strong> <?php  echo $item->getServiceName() ?> </strong> Giá : <strong><?php  echo product_price($item->getamount()) ?></strong> <br>
		
		<?php endforeach; ?>
	</div>
	<div class="col-xs-12 top20 "> 
		<button class="btn btn-success" id="bttService" onclick="BuyService()">MUA</button>
	</div>
	<div class="clear-fix"></div>
	<div  class="col-xs-12 top10 show_error">
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