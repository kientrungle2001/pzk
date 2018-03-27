<div id="service">
  <div class="layout_title"> MUA GÓI DỊCH VỤ </div>
  <div class="prf_clear"></div>
  <div class="note">
    - Sau khi nạp tiền vào tài khoản, bạn có thể dùng số tiền trong tài khoản của mình để mua các khóa học. <br>
    - Nếu số tiền trong tài khoản của bạn không đủ để mua gói dịch vụ mà bạn cần. Vui lòng <a class="deposit" href="/payment/payment">NẠP TIỀN TẠI ĐÂY</a>. <br>
    - Mỗi tài khoản có thể mua các gói dịch vụ khác nhau trên NextNobels <br>
    - Không nên cho người khác mượn tài khoản để học để tránh sự cố xảy ra <br> <br>
      Nếu bạn chưa có thẻ : <a class="deposit" href="/service/ordercard">Đặt mua thẻ</a>
  </div>

   <!--Begin Mua gói dịch vụ của nextnobels-->
  <div class="paycard_nextnobels" style="height: 250px;">
    
    <div class="pm_paycard_title">Mua các gói dịch vụ của NextNobels</div>
    <div class="pm_paycard_content">
        <div class="">
          Bạn hãy lựa chọn các gói dịch vụ bên dưới rồi nhấn nút  " MUA " để hoàn thành.
        </div>
         <?php 
            $service= $data->loadService();
            $discount= $data->loadDiscount();
           
          ?>
        <div class="pm_paycard_img_right"><img src=""></div>
        <div class="pm_paycard_form_napthe">
          <select name="service_type" id="opt_service_type" class="opt_service">
          <?php 
             foreach ($service as $item) {
              if(isset($discount[$item['id']])){
                $price_service=$item['amount'] -$item['amount']* $discount[$item['id']]['discount']/100;
              }else $price_service=$item['amount'];

           ?>
            <option  value="{item[id]} {price_service}">Gói:{item[serviceName]} (Giá :{item[amount]} VNĐ
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
          
          <input type="button" id="btt_service" class="pm_paycard_btt" value="MUA"> 
        </div>

        <div class="clear"></div>
        <div id="show_error_service" class="show_error"> </div>
        <div id="show_ok_service" class="show_ok"> </div>
                
    </div>

  </div>
  <!--End Nạp thẻ của nextnobels-->
   <div class="clear"></div>
    
   
   
 </div>
 <script>
 
  
  $('#btt_service').click(function(){
    $('#show_error_service').hide();
    $('#show_ok_service').hide();
    var opt_service_type= $('#opt_service_type').val();

      $.ajax({
        url:'/service/BuyService',
        data: {
          opt_service_type:opt_service_type
          
        },
        success: function(result)
        {
          
            if(result==0){
            $('#show_error_service').html('<span class="glyphicon glyphicon-remove-sign"></span><span >Số tiền trong tài khoản của bạn không đủ để mua gói dịch vụ này. Bạn vui lòng nạp thêm tiền </span><a class="deposit" href="/payment/payment">TẠI ĐÂY</a> ');
            $('#show_error_service').show();
          }else if(result==1) {
            $('#show_ok_service').html('<span class="glyphicon glyphicon-ok-sign"></span><span >Bạn vừa mua thành công gói dịch vụ : '+opt_service_type+' của NextNobels</span>');
            $('#show_ok_service').show();
          }
        }
      });
    
    //alert(opt_service_type);
  });
 </script>