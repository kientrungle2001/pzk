PzkPaymentPaycardmobile = PzkObj.pzkExt({

init: function() {
	function paycard()
	{
    	$('#pm_result_ok').hide();
    	$('#pm_result_fail').hide();
		var pm_txt_pincard = $('#pm_txt_pincard').val();
		var pm_txt_serialcard =$('#pm_txt_serialcard').val();
		var pm_typecard= $('#pm_typecard').val();
		
		$.ajax({
			url:'/payment/paycardPost',
			data: {
				pm_typecard: pm_typecard,
				pm_txt_serialcard: pm_txt_serialcard,
				pm_txt_pincard: pm_txt_pincard
			},
			success: function(result)
			{
				if(result=="ok")
				{
					//alert("Nap the thanh coong");
					$('#pm_result_ok').html('<span class="glyphicon glyphicon-ok"></span><span>  Bạn đã nạp thẻ thành công</span>');
				  $('#pm_result_ok').show();
        }
				else{
					//alert('nap the that bai');
					$('#pm_result_fail').html('<span  class="glyphicon glyphicon-remove"></span><span>'+result+'</span>');
					$('#pm_result_fail').show();
				}
				//alert(result);
			}
		});
		return false;
	}
	this.paycard= paycard;
	$(document).ready(function () {
	
			$("#paycardForm").validate({
				rules: {
					
					pm_txt_pincard: {
						required: true						
					},
					pm_txt_serialcard: {
						required: true										
					}
				},
				messages: {
					pm_txt_pincard :{
						required:"Yêu cầu nhập mã thẻ "						
					},
					pm_txt_serialcard: {
						required: 	"Yêu cầu nhập serial thẻ"						
					}
				}
			});
		});
}
});