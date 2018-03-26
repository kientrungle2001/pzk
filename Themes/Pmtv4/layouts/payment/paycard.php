<div class="row">
	<div class="col-xs-12">
		<h4><strong><span class="label label-success">Bước 1 </span>: Nạp tiền vào tài khoản bằng thẻ cào</strong> </h4>
		<ul>
			<li>Bạn phải đăng nhập trước khi nạp thẻ</li>
			<li>Giá trị của thẻ nạp sẽ được chuyển đổi tương đương thành số tiền trong tài khoản của bạn </li>
		</ul>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<span><strong> Giá trị quy đổi : </strong></span>
		<span class="label label-success"> 10.000 VNĐ </span><span>  giá trị thẻ nạp sẽ đổi được  </span>
		<span class="label label-danger"> 10.000 VNĐ </span>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="pay_card">	  
		  <h4 id="pm_result"></h4>
			<div class="pm_row">
				<div class="pm_colum1">Chọn nhà mạng </div>
				<div class="pm_colum2">
					<select id="pm_typecard" class="form-control col-md-3">
						<option value="VIETTEL">VIETTEL</option>
						<option value="VNP">VINAPHONE</option>
						<option value="VMS">MOBIFONE</option>
						<option value="GATE">GATE</option>
						<option value="VCOIN">VCOIN</option>
					</select>
				</div>
			</div>
			<div class="pm_row">
				<div class="pm_colum1">Mã số thẻ: </div>
				<div class="pm_colum2" >
					<input class="form-control" type="text" id="pm_txt_pincard" value="">
				</div>
			</div>
			<div class="pm_row">
				<div class="pm_colum1">Serial thẻ: </div>
				<div class="pm_colum2">
					<input class="form-control" type="text" id="pm_txt_serialcard"value="">
				</div>
			</div>
			<div class="pm_row">
				<div class="pm_colum1"></div>
				<div class="pm_colum2">
					<button class="btn btn-danger" onclick="PayCard();" name="btt_paycard" id="btt_paycard_mobile">NẠP THẺ</button>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12" id="newmoney"></div>
</div>
<?php if(pzk_session('userId')){ ?>
<div class="row"> 
  <div class="col-xs-12">
	<h4><strong>Tài khoản của bạn hiện có : </strong> <span class="label label-danger" id="wallet_money"><?php echo product_price(pzk_user()->getWallets(pzk_session('userId'))); ?></span></h4>
  </div> 
</div>
 <?php } ?>
<script>
	function PayCard()
	{
		var user= "<?php echo pzk_session('username'); ?>";
		if(user==''){
			alert('Bạn phải đăng nhập mới được nạp thẻ');
			return false;
		}
		pzk_{data.id}.postCard();
	}
</script>