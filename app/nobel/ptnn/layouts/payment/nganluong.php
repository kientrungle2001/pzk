<div class="payment">
  <div class="layout_title" style="width: 40%;"> NẠP TIỀN QUA NGÂN LƯỢNG </div>
  <div class="prf_clear"></div>
  <div class="note">
    - Bạn có thể nạp tiền vào tài khoản học của mình thông qua cổng thanh toán trực tuyến NgânLượng.vn.
      Hình thức nạp: <br>
        <div class="note2">
          1. Nạp tiền bằng tài khoản Ngân Lượng <br>
          2. Nạp tiền bằng thẻ cào điện thoại <br>
          3. Nạp tiền online bằng tài khoản ngân hàng <br>
        </div>
    - Sau khi nạp tiền thành công, chúng tôi sẽ cộng tiền vào tài khoản ví của bạn. <br>
    - Bạn có thể sử dụng tiền trong ví để mua các gói dịch vụ của Nextnobels<br> <br>
      
  </div>
  <div class="pm_change">
    <span class="pm_change1"> Giá trị quy đổi: </span>
    <span class="pm_change2"> 10.000 VNĐ  </span><span> sẽ cộng </span>
    <span class="pm_change3">10.000đ</span><span> vào tài khoản ví của bạn trên Nextnobels</span>
  </div>
  
<script language="javascript" src="<?php echo BASE_URL; ?>/3rdparty/nganluong/include/nganluong.apps.mcflow.js"></script>
  <?php 
  $nganluong= $data->PaymentNganLuong();

 ?>
   <div class="clear" style="margin-bottom: 10px;"></div>
   <div class="pm_payment">
     <div  id="pay_nganlluong" class="payment_click"><a onclick="pzk_{data.id}.Nganluong('{nganluong}');" href="#">NẠP QUA NGÂNLƯỢNG.VN</a></div>
     
   </div>
   

 </div>
 <script>
  
 </script>