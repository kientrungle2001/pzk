<div class="row">
  <div class="col-md-10 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12">
   <div class="row">
     <span> <strong>Chú ý: </strong>Để đặt mua thẻ bạn vui lòng điền đầy đủ các thông tin bên dưới. 
      Sau khi đặt mua thẻ chúng tôi sẽ gọi lại cho bạn để xác nhận thông tin 
      Chúng tôi sẽ gửi thẻ đến đúng địa chỉ như bạn đã đăng ký 
     </span> 
  </div>
   </div>
   <?php 
    $service  =  $data->loadService();

    $discount= $data->loadDiscount();
    ?>
<div class="col-md-10 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12">
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
              if(isset($discount[$item['id']])){
                $price = $item['amount'] - $item['amount']* $discount[$item['id']]['discount']/100;
              }else $price= $item['amount'];
			  
			  $couponDiscount = pzk_session()->getDiscount();
			 if($couponDiscount) {
				 $price = $price - $price * $couponDiscount;
			 }
        ?>

    
      <input type="radio" name="serviceId" checked value="<?php echo @$item['id']?>/<?php echo $price ?>"><strong><?php echo @$item['serviceName']?></strong> Giá : <strong><?php echo @$item['amount']?> VNĐ</strong> 
    <?php 
              if(isset($discount[$item['id']])){
                echo '<span class="label label-danger">Giảm giá : '.$discount[$item['id']]['discount'].'% Còn :'.$price. 'VNĐ </span>';
              }
            echo '<br>';
        }
        ?>
    
  </div>
        <div class="row">
          <label for="">Họ và tên:</label> <br>
          <input type="text" class="pm_paycard_input" cols="62" id="txtname" name="txtname"  placeholder="Điền họ tên"> 
        </div>
        <div class="row">
          <label for="">Số lượng thẻ:</label> <br>
          <input type="text" autocomplete="off" class="pm_paycard_input" cols="62" style="float:left;" id="txtquantity" name="txtquantity"  placeholder="Số lượng thẻ">
        </div>
        <div class="row">
          <label for="">Số điện thoại:</label> <br>
          <input type="text" autocomplete="off" cols="62" class="pm_paycard_input" style=" float:left;" id="txtphone" name="txtphone"  placeholder="Số điện thoại của bạn">
        
        </div>
        <div class="row">
          <label for="">Địa chỉ nhận thẻ:</label> <br>
          <textarea class="vb_textarea" id="txtaddress" name="txtaddress"  cols="62" rows="3"></textarea>
          <!-- <input type="text" autocomplete="off" class="pm_paycard_input" style="width: 123%;" id="txtaddress" name="txtaddress"  placeholder="Địa chỉ nhận thẻ"> -->
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

