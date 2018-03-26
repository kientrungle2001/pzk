<?php
# danh sách các gói thi
$testId = pzk_request()->getSegment(3);
$search = pzk_request()->get('name');
$testName = '';
if(is_numeric($testId)){
	$test =  _db()->selectAll()->fromTests()->whereId($testId)->result_one();
	$testName = strtolower($test['name']);
	
	$packages = _db()->selectAll()->fromService_packages()->whereServiceType('dotest')->whereStatus(1)->likeContestIds('%,'.$testId.',%')->result();
}else{
	$packages = _db()->selectAll()->fromService_packages()->whereServiceType('dotest')->whereStatus(1)->result();
}

$packageIds = array_map(function($package) {
	return $package['id'];
}, $packages);

$indexedPackages = array_combine($packageIds, $packages);
if($search){
	$payments = _db()->select('h.username, h.serviceId, u.phone, h.paymentDate')->from('history_payment as h')->join('user as u', 'h.username = u.username')
	->whereServiceType('dotest')->inServiceId($packageIds)
	->where(array('or', array('like', '`u`.phone', '%'.$search.'%'), array('like', '`h`.username',  '%'.$search.'%')))
	->orderBy('username asc')->result();
}else{
	$payments = _db()->select('h.username, h.serviceId, u.phone, h.paymentDate')->from('history_payment as h')->join('user as u', 'h.username = u.username')
	->whereServiceType('dotest')->inServiceId($packageIds)
	->orderBy('username asc')->result();
}	

?>
<h1 class="text-center">Danh sách thi <?php echo $testName; ?></h1>
<div class="container">

<div class="row">
	<form method="GET" class="navbar-form navbar-left">
		<div class="form-group">
		  <input type="text" name="name" value="{search}" class="form-control" placeholder="Tìm kiếm">
		</div>
		<button type="submit" class="btn btn-default">Tìm kiếm</button>
	</form>
</div>

<?php if(count($payments) > 0){ ?>
<table class="table table-bordered">
<tr>
<th>STT</th>
<th>Tên đăng nhập</th>
<th>Dịch vụ</th>
<th>Điện thoại</th>
<th>Ngày đăng ký</th>
</tr>
{each $payments as $index => $payment}
<tr>
	<td><?php echo ($index + 1)?></td>
	<td>{payment[username]}</td>
	<td><?php echo $indexedPackages[$payment['serviceId']]['serviceName']?></td>
	<td><?php if($payment['phone'] != ' '){ 
		$phone = $payment['phone'];
		$lenght = strlen($phone);

		$rp = str_repeat('*', $lenght);	
		$phone = substr($phone, -3); 
		echo $rp.$phone; 
	}
	?></td>
	<td><?php echo date('d/m/Y', strtotime($payment['paymentDate']))?></td>
</tr>
{/each}
</table>
<?php } ?>
</div>