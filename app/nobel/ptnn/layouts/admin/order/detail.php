<?php 
	$order=_db()->getEntity('service.order');

	$id=pzk_request()->getSegment(3);
	$order->loadWhere(array('id',$id));
	$username=$order->get('username');
	$userId=$order->getuserId();	
	$name=$order->getname();
	$phone=$order->getphone();
	$address=$order->getaddress();
	$serviceId=$order->getserviceId();
	$service= _db()->getEntity('service.service');
	if($serviceId){
		$service->loadWhere(array('id',$serviceId));
		$serviceName= $service->getServiceName();
	}else $serviceName='';
	$quantity=$order->getquantity();
	$amount=$order->getamount();
	$paymentType=$order->getpaymentType();
	$bank=$order->getbank();
	$orderDate=$order->getorderDate();
	$paymentStatus=$order->getpaymentStatus();
	if($paymentStatus==0){
		$paymentStatus='Chưa thành công';
	}else if ($paymentStatus==1){
		$paymentStatus='Thành công';
	}
	$note=$order->getnote();
	if($note){
		$service_= _db()->getEntity('service.service');
		$service_->loadWhere(array('id',$note));
		$note= $service_->getServiceName();
	}
	$activeUser=$order->getactiveUser();
	$status=$order->getstatus();
	if($status==0){
		$status='chờ xử lý';
	}else if($status==1){
		$status='Đã hoàn thành';
	}else if($status==-1){
		$status='Đã huỷ';
	}

	
 ?>
 <div class="panel panel-default">
 <div class="panel-heading">
 	<p align="center"> <strong>HOÁ ĐƠN {id}</strong></p>
 	<p align="center"><strong>(Ngày : {orderDate} - trạng thái hoá đơn: {status})</strong></p>
 </div>
 <table id="admin_table_list" class="table table-hover">
 	
 
 <tr>
  <th>userId: {userId}</th>
  <th>username: {username}</th>
  <th>Tên: {name}</th>
  <th>Điện thoại: {phone}</th>  
 </tr>
 <tr>
 	<th colspan="2">Địa chỉ: {address}</th>
 	<th colspan="2">Đặt mua thẻ Nextnobels: {note}</th>
 </tr>
 <tr>  
  <th>Mã dịch vụ: {serviceId}</th>
  <th>Tên dịch vụ: {serviceName}</th>
  <th>Số lượng: {quantity}</th>
  <th>Tổng tiền: {amount}</th>  
 </tr>
 <tr>  
  <th>Hình thức thanh toán: {paymentType}</th>
  <th>Ngân hàng: {bank}</th>
  <th>Trạng thái thanh toán: {paymentStatus}</th>
  <th>Trạng thái hoá đơn: {status}</th>  
 </tr>
 <tr>
 	<th colspan="4" style="padding-left: 400px;" >
 		<a class="btn btn-primary" href="{url /admin_order/edit}/{id}">Sửa</a>
 		<a class="btn btn-primary" href="{url /admin_order/index}">Trở lại</a>
 	</th>
 </tr>
 </table>
</div>

<?php 
	// Lấy dữ liệu trong bảng order_item

	$orderships= _db()->useCB()->select('order_shipping. *')->from('order_shipping')->where(array('orderId',$id))->result();
	if($orderships){
	$i=0;
	$enttService=_db()->getEntity('service.service');
 ?>
<div class="panel panel-default">
 <div class="panel-heading">
 	<p align="center"> <strong>CHI TIẾT HOÁ ĐƠN {id}</strong></p>
 	
 </div>
 <table id="admin_table_list" class="table table-hover">

 <tr>
 <th>STT</th>
  <th>Mã dịch vụ</th>
  <th>Tên dịch vụ</th>
  <th>Kiểu dịch vụ</th>
  <th>Số lượng</th>
  <th>Giá</th>  
  <th>Thành tiền</th>  
 </tr>	
 {each $orderships as $item}
 <?php 
 	$i++; 
 	$enttService->loadWhere(array('id',$item['serviceId']));
 ?>
 <tr>
 	<th>{i}</th>
  <th>{item[serviceId]}</th>
  <th>{enttService.getServiceName()} </th>
  <th>{item[serviceType]}</th>
  <th>{item[quantity]}</th>
  <th>{item[price]}</th>  
  <th>{item[amount]}</th>
 </tr>
 {/each}
 </table>
</div>
<?php } ?>	
<?php 
	// Lấy dữ liệu trong bảng order_shipping

	$orderships= _db()->useCB()->select('order_item. *')->from('order_item')->where(array('orderId',$id))->result();
	if($orderships){
			$i=0;
	$enttService=_db()->getEntity('service.service');
 ?>
<div class="panel panel-default">
 <div class="panel-heading">
 	<p align="center"> <strong>CHI TIẾT HOÁ ĐƠN {id}</strong></p>
 	
 </div>
 <table id="admin_table_list" class="table table-hover">
 <tr>
 <th>STT</th>
  <th>Mã dịch vụ</th>
  <th>Tên dịch vụ</th>
  <th>Số lượng</th>
  <th>Giá</th>  
  <th>Thành tiền</th>  
 </tr>	
 {each $orderships as $item}
 <?php 
 	$i++; 
 	$enttService->loadWhere(array('id',$item['serviceId']));
 ?>
 <tr>
 	<th>{i}</th>
  <th>{item[serviceId]}</th>
  <th>{enttService.getServiceName()} </th>
  <th>{item[quantity]}</th>
  <th>{item[price]}</th>  
  <th>{item[amount]}</th>
 </tr>
 {/each}
 </table>
</div>
<?php } ?>	
