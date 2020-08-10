<div class="payment">
  <div class="layout_title"> MUA GÓI DỊCH VỤ </div>
  <div class="prf_clear"></div>
  <div class="note">
    - Sau khi nạp tiền vào tài khoản, bạn có thể dùng số tiền trong tài khoản của mình để mua các khóa học. <br>
    - Nếu số tiền trong tài khoản của bạn không đủ để mua gói dịch vụ mà bạn cần. <br>
    - Vui lòng <a class="deposit" href="/payment/payment">NẠP TIỀN TẠI ĐÂY</a>. <br>
    - Mỗi tài khoản có thể mua các gói dịch vụ khác nhau trên NextNobels <br>
    - Không nên cho người khác mượn tài khoản để học để tránh sự cố xảy ra <br> <br>
      Nếu bạn chưa có thẻ : <a class="deposit" href="/service/ordercard">Đặt mua thẻ</a>
  </div>

   <!--Begin Mua gói dịch vụ của nextnobels-->
  <div class="paycard_nextnobels" style="height: 300px;">
    
    <div class="pm_paycard_title">Mua các gói dịch vụ của NextNobels</div>
    <div class="pm_paycard_content">
        <form action="Post" id="frmService" onsubmit="pzk_<?php echo @$data->id?>.buyService();return false;">
          <div style="margin-left: 10px;">
          Bạn hãy lựa chọn các gói dịch vụ bên dưới rồi nhấn nút  " MUA " để hoàn thành.
        </div>
         <?php
          
            $service= $data->loadService();
            $discount= $data->discount();
          ?>
        <div class="pm_paycard_img_right"><img src=""></div>
        <div class="pm_paycard_form_napthe">
          
          <?php 
             foreach ($service as $item) {
              if(isset($discount[$item['id']])){
                $price=$item['amount'] -$item['amount']* $discount[$item['id']]['discount']/100;
              }else $price= $item['amount'];
          ?>
          <div class="clear"></div>
          <div class="checkbox">
            <label><input type="checkbox" name="id[<?php echo @$item['id']?>]" value="<?php echo $price ?>"><?php echo @$item['serviceName']?> Giá: <?php echo @$item['amount']?> VNĐ
            <?php 
              if(isset($discount[$item['id']])){
                $price=$item['amount'] -$item['amount']* $discount[$item['id']]['discount']/100;
                echo 'Giảm giá : '.$discount[$item['id']]['discount'].'% Còn :'.$price. 'VNĐ';
              }
            ?>
            </label>
            
          </div>
          <?php   } ?> 
          
          <input type="submit" style="margin-top:10px; margin-left:30px;" id="btt_service" class="pm_paycard_btt" value="MUA"> 
        </div>
        </form>

        <div class="clear"></div>
        <div id="show_error_service" class="show_error"> </div>
        <div id="show_ok_service" class="show_ok"> </div>
    </div>

  </div>
   <div class="clear"></div>
 </div>
