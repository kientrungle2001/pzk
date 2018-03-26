<div class="row">
  <div class="col-xs-12">
   
     <h4> <strong>Chú ý: </strong>Để đặt mua thẻ bạn vui lòng điền đầy đủ các thông tin bên dưới. 
      Sau khi đặt mua thẻ chúng tôi sẽ gọi lại cho bạn để xác nhận thông tin.
      Chúng tôi sẽ gửi thẻ đến đúng địa chỉ như bạn đã đăng ký.
	  Mua số lượng lớn sẽ có chính sách giảm giá riêng, hãy gọi điện đến số 0919.56.36.11 để biết thêm chi tiết.
     </h4>
   </div>
</div>
   <?php 
    $service  	= 	_db()->getEntity('Service.Service');
    $items  	=  	$service->loadService();
	$discount 	= 	pzk_session('discount');
	$coupon		=	pzk_session('coupon');
    ?>
	<div class="col-xs-12">
		<form method="get">
			Mã giảm giá:
			<input type="text" name="coupon" value="{coupon}" />
			<button class="btn btn-danger">GỬI</button>
		</form>
	</div>
  <form id="orderCardForm"  onsubmit="return ordercard(); return false;" method="post">
        <div class="row">
		<div class="col-xs-12"> 
          <h4><strong>Hãy chọn gói sản phẩm :</strong></h4>
          {each $items as $item}
			  {? $price = $item->get('amount');
				$price = $price * (1 - $discount / 100);
			  ?}
            <input type="radio" name="serviceId"  checked value="<?php echo $item->get('id').'/'.$item->get('amount') ?>"><strong> {? echo $item->get('serviceName') ?} </strong> Giá ưu đãi: <strong>{? echo product_price($price) ?}{? if($discount): ?} <span>Giá gốc: {? echo product_price($item->get('amount')); ?}</span>{? endif; ?}</strong> <br>         
          {/each}
		</div>
        </div>
        <div class="row">
          <div class="col-xs-12">
		  <label for="">Mã giảm giá nếu có:</label> <br>
          <input type="text" class="pm_paycard_input" cols="62" id="txtcoupon" name="txtcoupon"  placeholder="Mã giảm giá nếu có" value="<?= pzk_session('coupon');?>"> 
		  </div>
		</div>
		<div class="row">
          <div class="col-xs-12">
		  <label for="">Họ và tên:</label> <br>
          <input type="text" class="pm_paycard_input" cols="62" id="txtname" name="txtname"  placeholder="Điền họ tên"> 
		  </div>
		</div>
        <div class="row">
          <div class="col-xs-12">
		  <label for="">Số lượng thẻ:</label> <br>
          <input type="text" autocomplete="off" class="pm_paycard_input" cols="62" style="float:left;" id="txtquantity" name="txtquantity"  placeholder="Số lượng thẻ">
		  </div>
		</div>
        <div class="row">
          <div class="col-xs-12">
		  <label for="">Số điện thoại:</label> <br>
          <input type="text" autocomplete="off" cols="62" class="pm_paycard_input" style=" float:left;" id="txtphone" name="txtphone"  placeholder="Số điện thoại của bạn">
        </div>
        </div>
        <div class="row">
          <div class="col-xs-12"> 
		  <label for="">Địa chỉ nhận thẻ:</label> <br>
          <textarea class="vb_textarea" id="txtaddress" name="txtaddress"  cols="62" rows="3"></textarea>
          </div>
        </div>
        <div class="clearfix"></div>
        <div id="orderOk"></div>
        <div class="clearfix"></div>
        <div class="row"> <div class="col-xs-12"> <input type="submit" id="ordercard_button" class="btn btn-danger" value=" ĐẶT MUA"> </div> </div>
		<div class="row">
		<div class="col-xs-12">
		<h4>Cần hỗ trợ trong quá trình nạp thẻ, vui lòng gọi đến số  0919.56.36.11 để được trợ giúp.</h4>
		</div>
		</div>
  </form>
<script>
  function ordercard(){
		var txtcoupon 		= $('#txtcoupon').val();
        var txtname 		= $('#txtname').val();        
        var txtphone		= $('#txtphone').val();
        var txtquantity		= $('#txtquantity').val();
        var txtaddress		= $('#txtaddress').val();
        var serviceId		= $('input[name="serviceId"]:checked').val();
        var className		= $('input[name="className"]:checked').val();
        var validator		= $("#orderCardForm").validate();
      
        if(txtname ==''|| txtphone ==''|| txtquantity ==''|| txtaddress ==''){
          alert('Bạn hãy nhập đầy đủ thông tin');
          return false;
        }else{
          $.ajax({
            url:'/service/orderFLSN',
            data: {
				txtcoupon:		txtcoupon,                
				txtname:		txtname,                
                txtphone:		txtphone,
                txtquantity:	txtquantity,
                txtaddress:		txtaddress,
                serviceId : 	serviceId,
                className : 	className
            },
              success: function(result)
              {
                  if(result == 1){
                    $('#orderOk').html('<H3> <span class="label label-success"><span class="glyphicon glyphicon-ok-sign"></span>Bạn vừa đặt mua thẻ thành công. Chúng tôi sẽ sớm liên hệ lại để xác nhận thông tin </span> </H3>');
                  }
              }
          });
        }
        
        return false; 
      }
</script>

