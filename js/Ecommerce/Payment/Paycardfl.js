PzkEcommercePaymentPaycardfl = PzkObj.pzkExt({
	init: function() {
	
		$(document).ready(function () {
	
			$("#paycardflForm").validate({
				rules:{
					
					flcardId:{
						required: true,
						
					},
					flserialcard:{
						required: true,
										
					},
					captcha:{
						required: true,
										
					}
				},
				messages:{
					flcardId :{
						required:"Hãy nhập mã thẻ cào",
						
						
					},
					flserialcard:{
						required:"Hãy nhập serial thẻ cào",
						
						
					},
					captcha:{
						required:"Hãy nhập mã bảo mật",
						
						
					}
				}
			});
		});
		
  		function paycardfl(){
  			
    		var flcardId = $('#flcardId').val();    		
    		var flserialcard= $('#flserialcard').val();
    		//var user = '<?php echo pzk_session("userId")?>';
    		var captcha = $('#captcha').val();
    		if(flcardId == '' || flserialcard == '' || captcha ==''){
    			
    			return false;
    		}
			$.ajax({
        		url:'/payment/cardflPost',
				type: 'POST',
        		data: {
         			flcardId:flcardId,          			
          			flserialcard:flserialcard,
          			captcha : captcha
        	},
	        success: function(result)
	        	{

	          		if(result == 1){
	          			$('#resultOk').html('<H3> <span class="label label-success"><span class="glyphicon glyphicon-ok-sign"></span>Bạn vừa nạp thẻ thành công. Vui lòng đăng nhập lại để sử dụng toàn bộ phần mềm! </span> </H3>');
	          		}else if(result == 2){
	          			 $('#resultOk').html('<H3> <span class="label label-danger "><span class="glyphicon glyphicon-remove-sign"></span> Thẻ đã được sử dụng </span> </H3>');
	          		}else if (result == 0){
	          			$('#resultOk').html('<H3> <span class="label label-danger "><span class="glyphicon glyphicon-remove-sign"></span> Mã thẻ chưa đúng </span> </H3>');
	          		}else if(result == 11) $('#resultOk').html('<H3> <span class="label label-danger "><span class="glyphicon glyphicon-remove-sign"></span> Mã bảo mật chưa đúng </span> </H3>');
	          		
	        	}
    		});
   			return false; 
  		}
  		this.paycardfl= paycardfl;
	}
});