
PzkServiceService = PzkObj.pzkExt({

  init: function() {

  },
  buyService: function(){
    $('#show_error_service').hide();
    $('#show_ok_service').hide();
    var formdata= $('#frmService').serializeForm();
    //console.log(formdata);
      $.ajax({
        url:'/service/BuyService',
        data: {
          service:formdata
          
        },
        success: function(result)
        {
          
          if(result==0){
            $('#show_error_service').html('<span class="glyphicon glyphicon-remove-sign"></span><span >Số tiền trong tài khoản của bạn không đủ để mua gói dịch vụ này. Bạn vui lòng nạp thêm tiền </span><a class="deposit" href="/payment/payment">TẠI ĐÂY</a> ');
            $('#show_error_service').show();
          }
          if(result==1){
            $('#show_ok_service').html('<span class="glyphicon glyphicon-ok-sign"></span><span >Bạn vừa mua thành công các gói dịch vụ của NextNobels!</span>');
            $('#show_ok_service').show();
          }
        }
      });
    
    }
});
