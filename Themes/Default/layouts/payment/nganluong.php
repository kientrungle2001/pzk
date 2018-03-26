<div class="container">
<div class="row">
  <div class="col-xs-12">
  <h2>NẠP THẺ ĐIỆN THOẠI</h2>
  </div>
  <div class="col-xs-12">
    - Giá trị thẻ nạp của bạn sẽ được chuyển đổi tương ứng thành đồng. <br>
    - Bạn có thể dùng số đồng trong tài khoản để mua gói THI THỬ <br>
    - Không nên cho người khác mượn tài khoản để học để tránh sự cố xảy ra <br> <br>
    
  </div>
  <div class="col-xs-12">
  	<strong> Giá trị quy đổi: </strong>
  	<span class="label label-success"> 10.000 VNĐ </span><span> giá trị thẻ nạp sẽ đổi được </span>
  	<span class="label label-danger"> 10.000đ </span>
  </div>
  <div id="oldmoney" class="col-xs-12">
    <strong>Tài khoản của bạn hiện có :</strong> <span class="label label-danger"><?php echo product_price(pzk_user()->getWallets(pzk_session('userId'))); ?></span>
  </div>
  <div class="col-xs-12" id="newmoney"></div>
  <div class="clear"></div>
  <div class="col-xs-12">
  <div class="pay_card">
  <div id="pm_result_ok"></div>
  <div id="pm_result_fail"></div>
  	<div class="pm_row">
  		<div class="pm_colum1">	Nhà mạng: 	</div>
  		<div class="pm_colum2">
  			<select id="pm_typecard">
  				<option value="VIETTEL">VIETTEL</option>
  				<option value="VNP">VINAPHONE</option>
  				<option value="VMS">MOBILEPHONE</option>
  				<option value="GATE">GATE</option>
  				<option value="VCOIN">VCOIN</option>
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
  <div> <a href="http://thitai.vn">THI THỬ</a></div>
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
			url:'/payment/cardPost',
			data: {
				pm_typecard: pm_typecard,
				pm_txt_serialcard: pm_txt_serialcard,
				pm_txt_pincard: pm_txt_pincard
			},
			success: function(result)
			{
        res= result.split('/');
				if(res[1]=="ok")
				{
					//alert("Nap the thanh coong");
					$('#pm_result_ok').html('<span class="glyphicon glyphicon-ok"></span><span>  Bạn vừa nạp thành công số tiền là '+res[0]+'</span>');
				  $('#pm_result_ok').show();
          $('#oldmoney').hide();
          $('#newmoney').html('<strong>Tài khoản của bạn hiện có :</strong><span class="label label-danger">'+res[2]+'</span>');
        }
				else{
					//alert('nap the that bai');
					$('#pm_result_fail').html('<span  class="glyphicon glyphicon-remove"></span><span>'+res[0]+'</span>');
					$('#pm_result_fail').show();
          

				}
				//alert(result);
			}
		});
	}
</script>
</div>