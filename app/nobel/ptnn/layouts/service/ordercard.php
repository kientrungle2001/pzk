<div class="payment">
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
    <form id="cardForm"  onsubmit="return pzk_<?php echo @$data->id?>.ordercard()" method="post">
        <div class="pm_paycard_form_napthe">
          <div class="ordercard_name">
            <label for="">Họ và tên:</label> <br>
            <input type="text" class="pm_paycard_input" id="txtname" name="txtname"  placeholder="Điền họ tên"> 
            
          </div>
          <div class="clearfix"></div>
          <div class="ordercard_select" >
          <label for="">Chọn loại thẻ:</label> <br>
          <select name="service_type" id="selectcard" class="opt_service">
          <?php 
             foreach ($service as $item) {
              if(isset($discount[$item['id']])){
                $price_service=$item['amount'] -$item['amount']* $discount[$item['id']]['discount']/100;
              }else $price_service=$item['amount'];

           ?>
            <option  value="<?php echo @$item['id']?> <?php echo $price_service ?> <?php echo @$item['serviceType']?>"><?php echo @$item['serviceName']?> (Giá :<?php echo @$item['amount']?> VNĐ
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
        <div class="clearfix"></div>
        <div class="ordercard_quantity">
          <label for="">Số lượng thẻ:</label> <br>
            <input type="text" autocomplete="off" class="pm_paycard_input" style="width: 270px; float:left;" id="quantity" name="quantity"  placeholder="Số lượng thẻ">
        </div>
        <div class="ordercard_quantity">
          <label for="">Số điện thoại:</label> <br>
            <input type="text" autocomplete="off" class="pm_paycard_input" style="width: 270px; float:left;" id="txtphone" name="txtphone"  placeholder="Số điện thoại của bạn">
          </div>
        <div class="clearfix"></div>
        <div class="ordercard_address">
          <label for="">Địa chỉ nhận thẻ:</label> <br>
            <input type="text" autocomplete="off" class="pm_paycard_input" style="width: 123%;" id="txtaddress" name="txtaddress"  placeholder="Địa chỉ nhận thẻ">
        </div>
        <div class="clearfix"></div>
        <div id="show_ok_ordercard" class="show_ok"> </div>
        <div id="show_error_txt" class="show_error"> </div>
        <div class="ordercard_button">
        <input type="submit" id="ordercard_button" class="pm_paycard_btt" value=" ĐẶT MUA"> </div>
        </div>
  </form>
        <div class="clearfix"></div>
    </div>

  </div>
  <!--End Nạp thẻ của nextnobels-->
   <div class="clear"></div>
 </div>