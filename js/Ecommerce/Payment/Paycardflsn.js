PzkEcommercePaymentPaycardflsn = PzkObj.pzkExt({
	init: function() {
	
		/*$(document).ready(function () {
	
			$("#paycardflsnForm").validate({
				rules:{
					
					flsncardId:{
						required: true,
						
					},
					flsnserialcard:{
						required: true,
										
					}
				},
				messages:{
					flsncardId :{
						required:"Hãy nhập mã thẻ cào",
						
						
					},
					flsnserialcard:{
						required:"Hãy nhập serial thẻ cào",
						
						
					}
				}
			});
		});*/
		
  		function paycardflsn(){
    		var flsncardId = $('#flsncardId').val();    		
    		var flsnserialcard= $('#flsnserialcard').val();
    		var user = '<?php echo pzk_session("userId")?>';
    		var captcha = $('#captcha').val();
    		if(flsncardId == '' || flsnserialcard == '' || captcha ==''){
    			alert('Bạn hãy nhập đầy đủ thông tin');
    			return false;
    		}
			$.ajax({
        		url:'/payment/cardflsnPost',
				type: 'POST',
        		data: {
         			flsncardId:flsncardId,          			
          			flsnserialcard:flsnserialcard,
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
	          		}else if(result == 11) alert("Mã bảo nhật chưa đúng"); 
	          		
	        	}
    		});
   			return false; 
  		}
  		this.paycardflsn= paycardflsn;
	}
});