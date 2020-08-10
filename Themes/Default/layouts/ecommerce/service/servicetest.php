<div class="container">
<div id="service">
   <!--Begin Mua gói dịch vụ của nextnobels-->
  <h2>MUA GÓI THI THỬ</h2>
  <div class="row">
    <div class="col-xs-12">
        <div>
          Bạn hãy nhấn nút  " MUA " để hoàn thành.
        </div>
         <?php 
            $item	= $data->loadService();
          ?>
        <div class="pm_paycard_form_napthe">
          <div class="col-md-6 col-xs-12 top10">
		  <select name="service_type" id="opt_service_type" class="form-control input-normal sharp">
          
            <option  value="<?php echo @$item['id']?> <?php echo @$item['amount']?>"><?php echo @$item['serviceName']?> (Giá: <?php  echo product_price($item['amount']); ?>
            </option>

           
          </select>
		  </div>
          <div class="col-md-3 col-xs-12 top10">
          <input type="button" id="bttService" class="btn btn-success sharp" value="MUA"> 
		  </div>
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
 
  
  $('#bttService').click(function(){
    $('#show_error_service').hide();
    $('#show_ok_service').hide();
    var opt_service_type= $('#opt_service_type').val();

      $.ajax({
        url:'/service/BuyTest',
        data: {
          opt_service_type:opt_service_type
          
        },
        success: function(result)
        {
          
            if(result==0){
            $('#show_error_service').html('<span class="glyphicon glyphicon-remove-sign"></span><span >Số tiền trong tài khoản của bạn không đủ để mua gói dịch vụ này. Bạn vui lòng nạp thêm tiền </span><a class="deposit" href="/payment/paycardmobile">TẠI ĐÂY</a> ');
            $('#show_error_service').show();
          }else if(result==1) {
            $('#show_ok_service').html('<span class="glyphicon glyphicon-ok-sign"></span><span >Bạn vừa mua thành công gói THI THỬ </span>');
            $('#show_ok_service').show();
          }
        }
      });
    
    //alert(opt_service_type);
  });
 </script>
 </div>