<div class="row">
	<div class="col-md-11 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12">
		<h4>Nạp tiền thông qua cổng thanh toán NgânLượng.vn</h4>
	</div>
	<div class="col-md-11 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12">
		
		<ul>
			Các hình thức thanh toán:
			<li>1. Thanh toán bằng tài khoản Ngân Lượng</li>			
			<li>2. Thanh toán online bằng tài khoản ngân hàng</li>
		</ul>
	</div>
<?php 
	$nl= pzk_model('Transaction');
	$url = $nl->PayNganLuong('fullook-sn','2000');
  
 ?>
	<script language="javascript" src="<?php echo BASE_URL; ?>/3rdparty/nganluong/include/nganluong.apps.mcflow.js">
		
	</script>
	<div class="col-md-11 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12">
		Click vào đây để mua tài khoản: 
		<button type="button" id="pay_nganluong" class="btn btn-success">Mua tài khoản</button>
	</div>
</div>
<script>
	
		var mc_flow = new NGANLUONG.apps.MCFlow({trigger:'pay_nganluong',url:'<?php echo $url; ?>'});


</script>