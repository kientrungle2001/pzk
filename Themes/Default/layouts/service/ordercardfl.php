<div class="row">
  <div class="col-md-10 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12">
   <div class="row">
     <h4> <strong>Chú ý: </strong>Để đặt mua thẻ bạn vui lòng điền đầy đủ các thông tin bên dưới. 
      Sau khi đặt mua thẻ chúng tôi sẽ gọi lại cho bạn để xác nhận thông tin 
      Chúng tôi sẽ gửi thẻ đến đúng địa chỉ như bạn đã đăng ký 
     </h4> 
  </div>
   </div>
   <?php 
    $service  = _db()->getEntity('Service.Service');
    $items  =  $service->loadService();
    ?>
<div class="col-md-10 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12">
  <form id="orderCardFormFL"  onsubmit="return ordercard(); return false;" method="post">
     
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
          <input type="submit" id="ordercard_button" class="btn btn-success" value=" ĐẶT MUA"> </div>
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
      
        if(txtname ==''|| txtphone ==''|| txtquantity ==''|| txtaddress ==''){
          alert('Bạn hãy nhập đầy đủ thông tin')
          return false;
        }else{
          $.ajax({
            url:'/service/orderFullook',
            data: {
              txtname:txtname,                
                txtphone:txtphone,
                txtquantity:txtquantity,
                txtaddress:txtaddress
                
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
