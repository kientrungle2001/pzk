<?php 
	$transaction=_db()->getEntity('payment.transaction');

	$id=pzk_request()->getSegment(3);
	$transaction->loadWhere(array('id',$id));
	$orderId=$transaction->getOrderId();
	$username=$transaction->getUsername();
	$userId=$transaction->getUserId();	
	$serviceId=$transaction->getService();
	$service= _db()->getEntity('service.service');
	if($serviceId){
		$service->loadWhere(array('id',$serviceId));
		$serviceName= $service->getServiceName();
	}else $serviceName='';	
	$amount=$transaction->getAmount();
	$paymentType=$transaction->getPaymentType();
	$paymentDate=$transaction->getPaymentDate();
	$transactionId=$transaction->getTransactionId();
	$paymentOption=$transaction->getPaymentOption();
	$transactionStatus=$transaction->getTransactionStatus();
	$reason=$transaction->getReason();
	$cardType=$transaction->getCardType();
	$cardAmount=$transaction->getCardAmount();
	$status=$transaction->getStatus();
	if($status==0){
		$status='Chưa thành công';
	}else if($status==1){
		$status='Đã thành công';
	}
 ?>
 <div class="panel panel-default">
 <div class="panel-heading">
 	<p align="center"> <strong>CHI TIẾT GIAO DỊCH {id}</strong></p>
 	<p align="center"><strong>(Ngày : {paymentDate} - trạng thái giao dịch: {status})</strong></p>
 </div>
 <table id="admin_table_list" class="table table-hover">
 	
 
 <tr>

  <th>userId: {userId}</th>
  <th>username: {username}</th>
  <th>Mã hoá đơn: {orderId}</th>
  
 </tr>
 
 <tr>  
  <th>Mã dịch vụ: {serviceId}</th>
  <th>Tên dịch vụ: {serviceName}</th>
 
  <th>Tổng tiền: {amount}</th>  
 </tr>
 <tr>  
  <th>Hình thức thanh toán: {paymentType}</th>
  <th>Mã giao dịch( Ngân Lượng): {transactionId}</th>
  <th>Kiểu thanh toán(Ngân Lượng):{paymentOption}</th>
  
 </tr>
 <tr>
 	<th>Loại thẻ cào: {cardType}</th>
 	<th>Mệnh giá thẻ: {cardAmount}</th>
 	<th>Trạng thái thanh toán: {transactionStatus}</th>
  	
 </tr>
 <tr>
 	<th>Diễn giải: {reason}</th>
 	<th>Trạng thái giao dịch: {status}</th>  
 </tr>
 <tr>
 	<th colspan="4" style="padding-left: 400px;" >
 		<a class="btn btn-primary" href="{url /admin_Ordertransaction/edit}/{id}">Sửa</a>
 		<a class="btn btn-primary" href="{url /admin_Ordertransaction/index}">Trở lại</a>
 	</th>
 </tr>
 </table>
</div>