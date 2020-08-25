<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="col-md-10 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12">
     <span> <strong>Chú ý: </strong>Để đặt mua thẻ bạn vui lòng điền đầy đủ các thông tin bên dưới. 
      Sau khi đặt mua thẻ chúng tôi sẽ gọi lại cho bạn để xác nhận thông tin 
      Chúng tôi sẽ gửi thẻ đến đúng địa chỉ như bạn đã đăng ký 
     </span> 
   </div>
   <?php 
    $service  		=  $data->loadService();
	$couponDiscount = 	pzk_session()->getDiscount();
	$coupon 		=	pzk_session('coupon');
    $discount		= $data->loadDiscount();
    ?>
	<div class="col-md-10 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12 select_service">
		<h5><strong>Nhập mã giảm giá(nếu có) :</strong></h5>
		<form>
			<input type="hidden" name="tab6" value="1" /> 
			<input type="text" name="coupon" value="<?php echo $coupon ?>" /> 
			<button class="btn btn-primary">Gửi</button>
		</form>
	</div>
	
<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
  <form id="orderCardForm"  onsubmit="return ordercard(); return false;" method="post">
        <div class="row">
          <span><strong>Hãy chọn lớp học :</strong></span> <br>
          <input type="radio" name="className"  value="3">Lớp 3
          <input type="radio" name="className" class="left10" value="4">Lớp 4
          <input type="radio" name="className" class="left10" checked value="5">Lớp 5
        </div>
        <div class="row">
    <h5><strong>Hãy chọn gói sản phẩm :</strong></h5>
    <?php 
            foreach ($service as $item) {
              $price = $item['amount'];
			  $discountPercent = pzk_or($couponDiscount, @$discount[$item['id']]['discount']);
              $price = $item['amount'] - $item['amount'] * $discountPercent /100;
        ?>

    
      <input type="radio" name="serviceId" checked value="<?php echo @$item['id']?>/<?php echo $price ?>"><strong ><?php echo @$item['serviceName']?></strong> Giá : <strong><?php  echo $item['amount'].'VNĐ'; ?><?php  if($discountPercent):?> <span>Giá gốc: <?php  echo product_price($item['amount']); ?></span> <?php  endif;?></strong> 
    <?php 
              if($discountPercent){
                echo '<div class="label label-danger"> Giảm '.$discountPercent.'% chỉ còn :<b style="font-size: 14px;">'.product_price($price). '</b>VNĐ </div>';
              }
            echo '<br>';
        }
        ?>
    
  </div>
    <div class="col-md-8 col-sm-8 col-xs-12">   
	
	<div class="form-group">
          <label for="">Mã giảm giá nếu có: </label> <br>
          <input type="text" class="form-control" id="txtcoupon" name="txtcoupon" value="<?= pzk_session()->getCoupon();?>"  placeholder="Điền mã giảm giá nếu có"> 
        </div>
	<div class="form-group">
          <label for="">Họ và tên: </label> <br>
          <input type="text" class="form-control" id="txtname" name="txtname"  placeholder="Điền họ tên"> 
        </div>
        <div class="form-group">
          <label for="">Số lượng thẻ:</label> <br>
          <input type="text" autocomplete="off" class="form-control" style="float:left;" id="txtquantity" name="txtquantity"  placeholder="Số lượng thẻ">
        </div>
        <div class="form-group">
          <label for="">Số điện thoại:</label> <br>
          <input type="text" autocomplete="off" class="form-control" style=" float:left;" id="txtphone" name="txtphone"  placeholder="Số điện thoại của bạn">
        
        </div>
        <div class="form-group">
          <label for="">Địa chỉ nhận thẻ:</label> <br>
          <textarea class="form-control" id="txtaddress" name="txtaddress" rows="3"></textarea>
          <!-- <input type="text" autocomplete="off" class="pm_paycard_input" style="width: 123%;" id="txtaddress" name="txtaddress"  placeholder="Địa chỉ nhận thẻ"> -->
        </div>
		</div>
        <div class="clearfix"></div>
        <div id="orderOk"></div>
        <div class="clearfix"></div>
        <div>
          <input type="submit" id="ordercard_button" class="btn btn-warning" value=" ĐẶT MUA"> </div>
        </div>
  </form>
</div>
</div>
<script>
  function ordercard(){
		var txtcoupon = $('#txtcoupon').val();
        var txtname = $('#txtname').val();        
        var txtphone= $('#txtphone').val();
        var txtquantity= $('#txtquantity').val();
        var txtaddress= $('#txtaddress').val();
        var serviceId= $('input[name="serviceId"]:checked').val();
        var className= $('input[name="className"]:checked').val();
        var validator= $("#orderCardForm").validate();
      
        if(txtname ==''|| txtphone ==''|| txtquantity ==''|| txtaddress ==''){
          alert('Bạn hãy nhập đầy đủ thông tin');
          return false;
        }else{
          $.ajax({
            url:'/service/orderFLSN',
            data: {
              txtname:txtname,                
                txtcoupon:txtcoupon,
				txtphone:txtphone,
                txtquantity:txtquantity,
                txtaddress:txtaddress,
                serviceId : serviceId,
                className : className
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

