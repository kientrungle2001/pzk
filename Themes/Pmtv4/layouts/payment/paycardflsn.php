<div class="row">  
    <div class="col-xs-12">
		<h4>Bạn hãy nhập mã thẻ và số serial vào ô bên dưới rồi nhấn "Nạp thẻ" để hoàn thành.</h4>
    </div>
</div> 
<div class="row"> 
    <div class="col-xs-12">
		<form id="paycardflsnForm" onsubmit="return paycardflsn(); return false;" method="post">
            <div class="col-xs-12">
				<label for="">Nhập mã thẻ:</label> <br>
				<input type="text" autocomplete="off" class="pm_paycard_input" id="flsncardId" name="flsncardId"  placeholder="Nhập mã kích hoạt">
            </div>
			<div class="col-xs-12">
				<label for="">Nhập số serial:</label> <br>
				<input type="text" autocomplete="off" class="pm_paycard_input" id="flsnserialId" name="flsnserialId"  placeholder="Nhập số serial">
            </div>
            <div class="clearfix"></div>
            <div id="resultOk"></div>
            <div class="clearfix"></div>
            <div class="top-20 left-20">
				<input type="submit" class="btn btn-danger" value="NẠP THẺ">
            </div>
		</form>
    </div>
	<div class="col-xs-12">
		<h4>Cần hỗ trợ trong quá trình nạp thẻ, vui lòng gọi đến số  0919.56.36.11 để được trợ giúp.</h4>
	</div>
</div>
<script>
  
  function paycardflsn(){
    var user= "<?php echo pzk_session('username'); ?>";
    if(user==''){
      alert('Bạn phải đăng nhập mới được nạp thẻ');
      return false;
    }
    var flsncardId 		= $('#flsncardId').val();
	var flsnserialId 	= $('#flsnserialId').val();
    var captcha 		= $('#captcha').val();
    if(flsncardId == ''){
      alert('Hãy nhập mã kích hoạt');
      return false;
    }
      $.ajax({
            url:'/payment/cardflPost',
            data: {
              flcardId:		flsncardId,
			  flserialId: 	flsnserialId
          },
          success: function(result)
            {
                if(result == 1){
                  $('#resultOk').html('<H3> <span class="label label-success"><span class="glyphicon glyphicon-ok-sign"></span>Chúc mừng bạn đã nạp thẻ thành công. Bây giờ bạn có thể sử dụng toàn bộ phần mềm! <a href="http://pmtv4.tiengviettieuhoc.vn">Click vào đây để vào phần mềm</a> </span> </H3>');
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
