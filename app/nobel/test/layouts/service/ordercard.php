<div id="order_card">
  <div class="layout_title">ĐẶT MUA THẺ</div>
  <div class="prf_clear"></div>
  <div class="note">
    Để đặt mua thẻ bạn vui lòng điền đầy đủ các thông tin bên dưới. <br>
    Sau khi đặt mua thẻ chúng tôi sẽ gọi lại cho bạn để xác nhận thông tin <br>
    Chúng tôi sẽ gửi thẻ đến đúng địa chỉ như bạn đã đăng ký 
  </div>

   <!--Begin Mua gói dịch vụ của nextnobels-->
  <div class="paycard_nextnobels" style="height: auto;">
    
    <div class="pm_paycard_title">Bạn hãy lựa chọn các loại thẻ ứng với các gói dịch vụ bên dưới</div>
    <div class="pm_paycard_content">
       
         <?php 
            $service= $data->loadService();
            $discount= $data->loadDiscount();
           
          ?>
        
        <div class="pm_paycard_form_napthe">
          <div class="ordercard_name">
            <label for="">Họ và tên:</label> <br>
            <input type="text" autocomplete="off" class="pm_paycard_input" id="ordercard_txtname" name="nextnobels_card"  placeholder="Điền họ tên"> 
             
          </div>
          <div class="ordercard_phone">
          <label for="">Số điện thoại:</label> <br>
            <input type="text" autocomplete="off" class="pm_paycard_input" id="ordercard_txtphone" name="nextnobels_card"  placeholder="Số điện thoại của bạn">
          </div>
          <div class="ordercard_select">
          <label for="">Chọn loại thẻ:</label> <br>
          <select name="service_type" id="ordercard_selectcard" class="opt_service">
          <?php 
             foreach ($service as $item) {
              if(isset($discount[$item['id']])){
                $price_service=$item['amount'] -$item['amount']* $discount[$item['id']]['discount']/100;
              }else $price_service=$item['amount'];

           ?>
            <option  value="<?php echo @$item['id']?> <?php echo $price_service ?>">Gói:<?php echo @$item['serviceName']?> (Giá :<?php echo @$item['amount']?> VNĐ
            <?php 
              if(isset($discount[$item['id']])){
                $price= $item['amount'] -$item['amount']* $discount[$item['id']]['discount']/100;
                echo ' - giảm giá: '.$discount[$item['id']]['discount'].'% . Còn : '.$price.'VNĐ ';
              }
              else $price= $item['amount'];
             ?>
            )</option>

           <?php   } ?> 

          </select>
        </div>
        <div class="ordercard_quantity">
          <label for="">Số lượng thẻ:</label> <br>
            <input type="text" autocomplete="off" class="pm_paycard_input" id="ordercard_quantity" name="nextnobels_card"  placeholder="Số lượng thẻ">
        </div>
        <div class="clear"></div>
        <div class="ordercard_address">
          <label for="">Địa chỉ nhận thẻ:</label> <br>
            <input type="text" autocomplete="off" class="pm_paycard_input" style="width: 80%;" id="ordercard_txtaddress" name="nextnobels_card"  placeholder="Địa chỉ nhận thẻ">
        </div>
        <div class="clear"></div>
        <div id="show_ok_ordercard" class="show_ok"> </div>
        <div id="show_error_txt" class="show_error"> </div>
        <div class="ordercard_button">
        <input type="button" id="ordercard_button" class="pm_paycard_btt" value=" ĐẶT MUA"> </div>
        </div>

        <div class="clear"></div>
        
        
                
    </div>

  </div>
  <!--End Nạp thẻ của nextnobels-->
   <div class="clear"></div>
    
   
   
 </div>



 <script>
 
  
  $('#ordercard_button').click(function(){
    $('#show_ok_ordercard').hide();
    $('#show_error_txt').hide();
    var ordercard_txtname = $('#ordercard_txtname').val();
    var ordercard_selectcard= $('#ordercard_selectcard').val();
    var ordercard_txtphone= $('#ordercard_txtphone').val();
    var ordercard_quantity= $('#ordercard_quantity').val();
    var ordercard_txtaddress= $('#ordercard_txtaddress').val();
  if(ordercard_txtname==''||ordercard_txtphone==''||ordercard_quantity==''||ordercard_txtaddress=='')
  {
    
    $('#show_error_txt').html('<span class="glyphicon glyphicon-remove-sign"></span><span >Bạn vui lòng điền đầy đủ các thông tin để chúng tôi có thể chuyển thẻ tới cho bạn nhanh nhất</span>');
    $('#show_error_txt').show();
    return false;
  }
 
   $.ajax({
        url:'/service/OrderCardNexnobels',
        data: {
          ordercard_txtname:ordercard_txtname,
          ordercard_selectcard:ordercard_selectcard,
          ordercard_txtphone:ordercard_txtphone,
          ordercard_quantity:ordercard_quantity,
          ordercard_txtaddress:ordercard_txtaddress
        },
        success: function(result)
        {
          alert(result);
          if(result==1) 
          {
            $('#show_ok_ordercard').html('<span class="glyphicon glyphicon-ok-sign"></span><span >Cảm ơn bạn đã đặt mua thẻ của NextNobels. Chúng tôi sẽ liên lạc và chuyển thẻ đến cho bạn trong thời gian sớn nhất</span> <br> Trân trọng!');
            $('#show_ok_ordercard').show();
          }
        }
      });
    
    //alert(opt_service_type);
  });
 </script>