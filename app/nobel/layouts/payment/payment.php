<div id="payment">
  <div class="layout_title"> NẠP THẺ </div>
  <div class="prf_clear"></div>
  <div class="note">
    - Sau khi nạp thẻ thành công bạn sẽ được học chương trình tương ứng in trên thẻ. <br>
    - Nếu tài khoản của bạn ứng với chương trình học in trên thẻ vẫn còn ngày học trên trang web thì bạn sẽ không nạp thẻ được nữa. <br>
    - Mỗi tài khoản có thể nạp thẻ cho tất cả các chương trình học có trên NextNobels <br>
    - Không nên cho người khác mượn tài khoản để học để tránh sự cố xảy ra <br> <br>
      Nếu bạn chưa có thẻ : <a href="/service/ordercard">Đặt mua thẻ</a>
      <br>
      <br>
      Sau khi nạp tiền thành công bạn có thể mua trực tiếp các gói dịch vụ của NextNobels <span style="color:#f51353;font-size:30px;  "class="glyphicon glyphicon-star-empty"></span> <a style="color:#f51353;font-weight: bold;  " href="/service/service">TẠI ĐÂY</a>
  </div>

  <!--Begin Nạp tiền trực tiếp  qua NL-->
  <div class="payment_option" ></div>
  <!--End Nạp tiền trực tiếp  qua NL-->
  
   <!--Begin Nạp thẻ của nextnobels-->
  <div class="paycard_nextnobels">
    
    <div class="pm_paycard_title">Nạp thẻ bằng thẻ NextNobels</div>
    <div class="pm_paycard_content">
        <div class="pm_paycard_text_left">
          Bạn hãy cào thẻ và  điền 16 chữ số mã thẻ vào ô bên dưới rồi nhấn "Nạp thẻ" để hoàn thành.
        </div>
        <div class="pm_paycard_img_right"><img src=""></div>
        <div class="pm_paycard_form_napthe">
          <input type="text" autocomplete="off" class="pm_paycard_input" id="nextnobels_card" name="nextnobels_card"  placeholder="Nhập mã số nạp thẻ">
          <br>
          <input type="text" autocomplete="off" class="pm_paycard_input" id="nextnobels_serial" name="pm_serial_input"  placeholder="Nhập số serial">

          <input type="button" id="pm_bttNextnobels" class="pm_paycard_btt" value="Nạp thẻ"> 
        </div>

        <div class="clear"></div>
        <div id="show_error_paycard_nextnobels"> </div>
        <div id="show_ok_paycard_nextnobels"></div>
        <div class="pm_paycard_note">(Mã thẻ bao gồm các số từ 0 đến 9 và các chữ cái A, B, C, D, E, F)</div>
        
    </div>

  </div>
  <!--End Nạp thẻ của nextnobels-->
   <div class="clear"></div>
    <div class="note"> Nếu bạn chưa có thẻ của NextNobels có thể sử dụng các hình thức dưới đây</div>
   <div class="clear"></div>
   <div class="pm_payment">
     <div  id="pm_payment_nganluong" class="pm_payment_nganluong"><a href="#">NẠP QUA NGÂNLƯỢNG.VN</a></div>
     <div class="pm_payment_paycard"><a href="/payment/paycardmobile">NẠP THẺ CÀO ĐIỆN THOẠI</a></div>
     <div class="pm_payment_nganluong" style="margin-top: 20px;"><a href="/payment/bank">CHUYỂN KHOẢN NGÂN HÀNG</a></div>
   </div>
   <script language="javascript" src="../3rdparty/nganluong/include/nganluong.apps.mcflow.js"></script>
<?php 
  $nganluong= $data->PaymentNganLuong();

 ?>
 </div>
 <script>
  var mc_flow = new NGANLUONG.apps.MCFlow({trigger:'pm_payment_nganluong',url:'<?php echo @$nganluong;?>'});
  
  $('#pm_bttNextnobels').click(function(){
    $('#show_error_paycard_nextnobels').hide();
    $('#show_ok_paycard_nextnobels').hide();
    var nextnobels_card= $('#nextnobels_card').val();
    var nextnobels_serial= $('#nextnobels_serial').val();
    if('nextnobels_card'=='')
    {
      alert('Bạn chưa nhập mã thẻ');
    }else
    {
      $.ajax({
        url:'/payment/PaymentNextNobels',
        data: {
          nextnobels_card:nextnobels_card,
          nextnobels_serial:nextnobels_serial
        },
        success: function(result)
        {
          
          
          if(result==0){
            $('#show_error_paycard_nextnobels').html(' <span class="glyphicon glyphicon-remove"></span><span> Mã thẻ hoặc serial không đúng</span>');
            $('#show_error_paycard_nextnobels').show();
          }else if(result==1) {
            $('#show_ok_paycard_nextnobels').html('<span class="glyphicon glyphicon-ok"></span><span>Bạn đã nạp thẻ thành công</span>');
            $('#show_ok_paycard_nextnobels').show();
          }else if(result==2){
            $('#show_error_paycard_nextnobels').html('<span class="glyphicon glyphicon-remove"></span><span> Mã thẻ đã được sử dụng</span>');
            $('#show_error_paycard_nextnobels').show();
          }
        }
      });
    }
    //alert(nextnobels_card);
  });
 </script>