
<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12">
	<h4><strong><span class="label label-success">Bước 1 </span>: Nạp tiền vào tài khoản bằng thẻ cào</strong> </h4>
	<ul class="item">
		<li>Bạn phải đăng nhập trước khi nạp thẻ</li>
		<li>Giá trị của thẻ nạp sẽ được chuyển đổi tương đương thành số tiền trong tài khoản của bạn </li>
	</ul>
</div>
<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12">
	<span><strong> Giá trị quy đổi : </strong></span>
	<span class="label label-success"> 10.000 VNĐ </span><span>  giá trị thẻ nạp sẽ đổi được  </span>
	<span class="label label-danger"> 10.000 VNĐ </span>
</div>
<div class="clear-fix"></div>
<div class="item">
	<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12">	  
		<div class="col-md-3 col-sm-4 col-xs-5"><strong>Chọn nhà mạng </strong></div>
		<div class="col-md-3 col-sm-4 col-xs-7 form-group">
			<select id="pm_typecard" class="form-control">
				<option value="VIETTEL">VIETTEL</option>
				<option value="VNP">VINAPHONE</option>
				<option value="VMS">MOBIFONE</option>
				<option value="GATE">GATE</option>
				<option value="VCOIN">VCOIN</option>
			</select>
		</div>
	</div>
	<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12">
		<div class="col-md-3 col-sm-4 col-xs-5"><strong>Mã số thẻ: </strong></div>
		<div class="col-md-3 col-sm-4 col-xs-7 form-group" >
			<input class="form-control" type="text" id="pm_txt_pincard" value="">
		</div>
	</div>
	<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12">
		<div class="col-md-3 col-sm-4 col-xs-5"><strong>Serial thẻ: </strong></div>
		<div class="col-md-3 col-sm-4 col-xs-7 form-group">
			<input class="form-control" type="text" id="pm_txt_serialcard"value="">
		</div>
	</div>
	<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12">
		<div class="col-md-3 col-sm-4 col-xs-5"></div>
		<div class="col-md-3 col-sm-4 col-xs-7">
			<button class="btn btn-success" onclick="PayCard();" name="btt_paycard" id="btt_paycard_mobile">NẠP THẺ</button>
		</div>
		<h4 id="pm_result" class="item" ></h4>
	</div>
</div>
<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12" id="newmoney"></div>
<?php if(pzk_session('userId')){ ?>
  <div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12">
	<h4><strong>Tài khoản của bạn hiện có : </strong> <span class="label label-danger" id="wallet_money"><?php echo product_price(pzk_user()->getWallets(pzk_session('userId'))); ?></span></h4>
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
		pzk_<?php echo @$data->id?>.postCard();
	}
</script>
