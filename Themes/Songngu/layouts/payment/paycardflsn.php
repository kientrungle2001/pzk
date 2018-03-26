
  
    <div class="col-md-10 col-md-offset-2 col-sm-10 col-sm-offset-2 col-xs-12">
      <h4>Bạn hãy cào thẻ và  điền mã kích hoạt vào ô bên dưới rồi nhấn "Nạp thẻ" để hoàn thành.</h4>
    </div>
    <div class="col-md-10 col-md-offset-2 col-sm-10 col-sm-offset-2 col-xs-12">
      <form id="paycardflsnForm"  onsubmit="return paycardflsn(); return false;" method="post">
            
            <div class="col-md-8  col-sm-8  col-xs-12">
              <label for="">Nhập mã kích hoạt:</label> <br>
              <input type="text" autocomplete="off" class="pm_paycard_input" id="flsncardId" name="flsncardId"  placeholder="Nhập mã kích hoạt">
            </div>
            <div class="clearfix"></div>
            <div id="resultOk"></div>
            <div class="clearfix"></div>
            <div class="top20 left20">
              <input type="submit"  class="btn btn-danger" value=" NẠP THẺ">
            </div>
      </form>
    </div>
<script>
  
  function paycardflsn(){
    var user= "<?php echo pzk_session('username'); ?>";
    if(user==''){
      alert('Bạn phải đăng nhập mới được nạp thẻ');
      return false;
    }
    var flsncardId = $('#flsncardId').val();
    var captcha = $('#captcha').val();
    if(flsncardId == ''){
      alert('Hãy nhập mã kích hoạt');
      return false;
    }
      $.ajax({
            url:'/payment/cardflPost',
            data: {
              flcardId:flsncardId
          },
          success: function(result)
            {
                if(result == 1){
                  $('#resultOk').html('<H3> <span class="label label-success"><span class="glyphicon glyphicon-ok-sign"></span>Chúc mừng bạn đã nạp thẻ thành công. Bây giờ bạn có thể sử dụng toàn bộ phần mềm! </span> </H3>');
                }else if(result == 2){
                   $('#resultOk').html('<H3> <span class="label label-danger "><span class="glyphicon glyphicon-remove-sign"></span> Thẻ đã được sử dụng </span> </H3>');
                }else if (result == 0){
                  $('#resultOk').html('<H3> <span class="label label-danger "><span class="glyphicon glyphicon-remove-sign"></span> Mã thẻ chưa đúng </span> </H3>');
                }
            }
        });
        return false; 
      }
</script>
