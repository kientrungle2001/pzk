PzkPaymentPayment = PzkObj.pzkExt({

	init: function() {
		
  
  $('#pm_bttNextnobels').click(function(){
    $('#mass_error').hide();
    $('#mass-ok').hide();
    var nextnobels_card= $('#nextnobels_card').val();
    var nextnobels_serial= $('#nextnobels_serial').val();
    if(nextnobels_card==''|| nextnobels_serial=='')
    {
      alert('Bạn phải nhập đầy đủ cả mã thẻ và serial!');
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
            $('#mass_error').html(' <span class="glyphicon glyphicon-remove"></span><span> Mã thẻ hoặc serial không đúng</span>');
            $('#mass_error').show();
          }else if(result==1) {
            $('#mass-ok').html('<span class="glyphicon glyphicon-ok"></span><span>Bạn đã nạp thẻ thành công</span>');
            $('#mass-ok').show();
          }else if(result==2){
            $('#mass_error').html('<span class="glyphicon glyphicon-remove"></span><span> Mã thẻ đã được sử dụng</span>');
            $('#mass_error').show();
          }
        }
      });
    }
    //alert(nextnobels_card);
  });
	},
  Nganluong: function(nganluong){
    var mc_flow = new NGANLUONG.apps.MCFlow({trigger:'pay_nl',url:nganluong});
  }
});