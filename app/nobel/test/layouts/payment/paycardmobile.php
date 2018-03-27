<div id="pay_card_moblie">
  <div class="layout_title"> NẠP THẺ ĐIỆN THOẠI</div>
  <div class="prf_clear"></div>
  <div class="note">
    - Giá trị thẻ nạp của bạn sẽ được chuyển đổi tương ứng thành đồng. <br>
    - Bạn có thể dùng số đồng trong tài khoản để mua các gói chấm. <br>
    
    - Không nên cho người khác mượn tài khoản để học để tránh sự cố xảy ra <br> <br>
    
  </div>
  <div class="pm_change">
  	<span class="pm_change1"> Giá trị quy đổi: </span>
  	<span class="pm_change2"> 10.000 VNĐ  </span><span>giá trị thẻ nạp sẽ đổi được</span>
  	<span class="pm_change3">10.000đ</span>
  </div>
  <div class="clear"></div>
  <div class="pay_card">
  <div id="pm_result_ok"></div>
  <div id="pm_result_fail"></div>
  	<div class="pm_row">
  		<div class="pm_colum1">	Nhà mạng: 	</div>
  		<div class="pm_colum2">
  			<select id="pm_typecard">
  				<option value="viettel">VIETTEL</option>
  				<option value="vina">VINAPHONE</option>
  				<option value="mobile">MOBILEPHONE</option>
  				<option value="gate">GATE</option>
  				<option value="vcoin">VCOIN</option>
			</select>
  		</div>
	</div>
	<div class="pm_row">
  		<div class="pm_colum1">Mã số thẻ: </div>
  		<div class="pm_colum2">
  			<input type="text" id="pm_txt_pincard" value="">
  		</div>
	</div>
	<div class="pm_row">
  		<div class="pm_colum1">Số serial thẻ: </div>
  		<div class="pm_colum2">
  			<input type="text" id="pm_txt_serialcard"value="">
  		</div>
	</div>
	<div class="pm_row">
  		<div class="pm_colum1">
  			
  		</div>
  		<div class="pm_colum2">
  			<input type="button" class="btt_paycard" onclick="PayCard()" name="btt_paycard" id="btt_paycard_mobile" value="Nạp thẻ">
  		</div>
	</div>

  </div>
</div>
<script>
	function PayCard()
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
	}
</script>