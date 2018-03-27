<div class="row">
  <div class="col-xs-12">
     <h4 class="text-uppercase">Đặt mua thẻ Happy Way</h4> 
	 <strong>Chú ý: </strong>Để đặt mua thẻ bạn vui lòng điền đầy đủ các thông tin bên dưới. 
      Sau khi đặt mua thẻ chúng tôi sẽ gọi lại cho bạn để xác nhận thông tin 
      Chúng tôi sẽ gửi thẻ đến đúng địa chỉ như bạn đã đăng ký 
   </div>
   <?php 
    $service  = _db()->getEntity('Service.Service');
    $items  =  $service->loadService();
    ?>
<div class="col-xs-12">
  <form id="orderCardForm"  onsubmit="return pzk_{data.id}.ordercard()" method="post">
        <div class="row row-npd">
		  <h4><strong>Hãy chọn lớp học :</strong></h4>
          <input type="radio" name="className"  value="3">Lớp 3
          <input type="radio" name="className" class="left10" value="4">Lớp 4
          <input type="radio" name="className" class="left10" checked value="5">Lớp 5
        </div>
		<div class="row row-npd">
		  <h4><strong>Hãy chọn gói sản phẩm :</strong></h4>
          {each $items as $item}
            <input type="radio" name="serviceId"  checked value="<?php echo $item->get('id').'/'.$item->get('amount') ?>"><strong> {? echo $item->get('serviceName') ?} </strong> Giá : <strong>{? echo product_price($item->get('amount')) ?}</strong> <br>         
          {/each}
		</div>
		<div class="row row-npd">
          <label for="">Họ và tên:</label> <br>
          <input type="text" class="pm_paycard_input" cols="62" id="txtname" name="txtname"  placeholder="Điền họ tên"> 
        </div>
		<div class="row row-npd">
		  <label for="">Số lượng thẻ:</label> <br>
          <input type="text" autocomplete="off" class="pm_paycard_input" cols="62" style="float:left;" id="txtquantity" name="txtquantity"  placeholder="Số lượng thẻ">
        </div>
		<div class="row row-npd">
		  <label for="">Số điện thoại:</label> <br>
          <input type="text" autocomplete="off" cols="62" class="pm_paycard_input" style=" float:left;" id="txtphone" name="txtphone"  placeholder="Số điện thoại của bạn">
		</div>
		<div class="row row-npd">
          <label for="">Địa chỉ nhận thẻ:</label> <br>
          <textarea class="vb_textarea" id="txtaddress" name="txtaddress"  cols="62" rows="3"></textarea>
          <!-- <input type="text" autocomplete="off" class="pm_paycard_input" style="width: 123%;" id="txtaddress" name="txtaddress"  placeholder="Địa chỉ nhận thẻ"> -->
        </div>
		<div id="orderOk"></div>
        <div class="clearfix"></div>
        <div class="row row-npd"><input type="submit" id="ordercard_button" class="btn btn-warning" value="ĐẶT MUA"> </div>
  </form>
</div>
</div>