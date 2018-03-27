PzkEcommerceServiceOrdercardsn = PzkObj.pzkExt({

	init: function() {
		$(function () {
			$('[data-toggle="tooltip"]').tooltip()
		});
		
		$(document).ready(function () {
	
			$("#orderCardForm").validate({
				rules: {
					
					txtname: {
						required: true
					},
					txtphone: {
						required: true,
						number:true						
					},
					txtquantity: {
						required: true,
						number:true
					},
					txtaddress: {
						required: true,
						minlength: 10
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
					txtquantity: {
						required: 	"Bạn vui lòng nhập số lượng thẻ",
						number: 	"Số lượng phải là số"
						
					},
					txtaddress: {
						required: 	"Bạn vui lòng nhập địa chỉ",
						minlength : "Địa chỉ ít nhất 10 ký tự"						
					}
				}
			});
		});
		
  		function ordercard(){
    		var txtname = $('#txtname').val();    		
    		var txtphone= $('#txtphone').val();
    		var txtquantity= $('#txtquantity').val();
    		var txtaddress= $('#txtaddress').val();
    		var serviceId= $('input[name="serviceId"]:checked').val();
	    	var className= $('input[name="className"]:checked').val();
	    	var validator= $("#orderCardForm").validate();
			var error= validator.numberOfInvalids();
	    	if(error > 0 || txtname ==''|| txtphone ==''|| txtquantity ==''|| txtaddress ==''){
	    		return false;
	    	}else{
	    		$.ajax({
        		url:'/service/orderFLSN',
				type: 'POST',
        		data: {
         			txtname:txtname,          			
          			txtphone:txtphone,
          			txtquantity:txtquantity,
          			txtaddress:txtaddress,
          			serviceId : serviceId,
          			className : className
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
  		this.ordercard= ordercard;
	}

});
		