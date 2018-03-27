PzkEcommerceServiceOrdercard = PzkObj.pzkExt({

	init: function() {
		$(function () {
			$('[data-toggle="tooltip"]').tooltip()
		});
		
		$(document).ready(function () {
	
			$("#cardForm").validate({
				rules: {
					
					txtname: {
						required: true
					},
					txtphone: {
						required: true,
						number:true						
					},
					quantity: {
						required: true,
						number:true
					},
					txtaddress: {
						required: true
						
					}
				},
				messages: {
					txtname :{
						required:"Hãy điền họ tên của bạn "
					},
					txtphone: {
						required: 	"Bạn vui lòng nhập số điện thoại",
						number: 	" Điện thoại phải là số"
						
					},
					quantity: {
						required: 	"Bạn vui lòng nhập số lượng thẻ",
						number: 	"Số lượng phải là số"
						
					},
					txtaddress: {
						required: 	"Bạn vui lòng nhập địa chỉ"
						
					}
				}
			});
		});
		
  		function ordercard(){

    		$('#show_ok_ordercard').hide();
    		$('#show_error_txt').hide();
    		var txtname = $('#txtname').val();
    		var selectcard= $('#selectcard').val();
    		var txtphone= $('#txtphone').val();
    		var quantity= $('#quantity').val();
    		var txtaddress= $('#txtaddress').val();
  			
   			$.ajax({
        		url:'/service/OrderCardP',
				type: 'POST',
        		data: {
         			txtname:txtname,
          			selectcard:selectcard,
          			txtphone:txtphone,
          			quantity:quantity,
          			txtaddress:txtaddress
        	},
        	success: function(result)
        	{
          		if(result==1) 
          		{
            		$('#show_ok_ordercard').html('<span class="glyphicon glyphicon-ok-sign"></span><span >Cảm ơn bạn đã đặt mua thẻ của NextNobels. Chúng tôi sẽ liên lạc và chuyển thẻ đến cho bạn trong thời gian sớn nhất</span> <br> Trân trọng!');
            		$('#show_ok_ordercard').show();
          		}
        	}
    		});
   			return false; 
  		}
  		this.ordercard= ordercard;
	}

});
		