<div class="payment">
  <div class="layout_title"> NẠP THẺ </div>
  <div class="prf_clear"></div>
  <div class="note">
    - Sau khi nạp thẻ thành công bạn sẽ được học chương trình tương ứng in trên thẻ. <br>
    - Nếu tài khoản của bạn ứng với chương trình học in trên thẻ vẫn còn ngày học trên trang web thì bạn sẽ không nạp thẻ được nữa. <br>
    - Mỗi tài khoản có thể nạp thẻ cho tất cả các chương trình học có trên NextNobels <br>
    - Không nên cho người khác mượn tài khoản để học để tránh sự cố xảy ra <br> <br>
      Nếu bạn chưa có thẻ : <a href="/service/ordercard">ĐẶT MUA THẺ</a>
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
        <div class="show_error" id="mass_error"> </div>
        <div class="show_ok"  id="mass-ok"></div>
        <div class="pm_paycard_note">(Mã thẻ bao gồm các số từ 0 đến 9 và các chữ cái A, B, C, D, E, F)</div>
        
    </div>

  </div>
  <!--End Nạp thẻ của nextnobels-->
<script language="javascript" src="<?php echo BASE_URL; ?>/3rdparty/nganluong/include/nganluong.apps.mcflow.js"></script>
  <?php 
  $nganluong= $data->PaymentNganLuong();

 ?>
   <div class="clear"></div>
    <div class="note"> Nếu bạn chưa có thẻ của NextNobels có thể sử dụng các hình thức dưới đây</div>
   <div class="clear"></div>
   <div class="pm_payment">
     <div  id="pay_nl" class="payment_click"><a onclick="pzk_{data.id}.Nganluong(' <?php echo $nganluong; ?>');" href="#">NẠP QUA NGÂNLƯỢNG.VN</a></div>
     <div class="payment_click" style="margin-right: 10px; float:right;"><a href="/payment/paycardmobile">NẠP THẺ CÀO ĐIỆN THOẠI</a></div>
     <div   class="payment_click" style="margin-top: 20px;"><a href="/payment/bank">CHUYỂN KHOẢN NGÂN HÀNG</a></div>
   </div>
   

 </div>
