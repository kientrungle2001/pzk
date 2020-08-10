<?php 
	$order=_db()->getEntity('service.order');

	$id=pzk_request()->getSegment(3);
	$order->loadWhere(array('id',$id));
	$username=$order->getUsername();
	$userId=$order->getUserId();	
	$name=$order->getName();
	$phone=$order->getPhone();
	$address=$order->getAddress();
	$serviceId=$order->getServiceId();
	$service= _db()->getEntity('service.service');
	if($serviceId){
		$service->loadWhere(array('id',$serviceId));
		$serviceName= $service->getServiceName();
	}else $serviceName='';
	$quantity=$order->getQuantity();
	$amount=$order->getAmount();
	$paymentType=$order->getPaymentType();
	$bank=$order->getBank();
	$orderDate=$order->getOrderDate();
	$paymentStatus=$order->getPaymentStatus();
	if($paymentStatus==0){
		$paymentStatus='Chưa thành công';
	}else if ($paymentStatus==1){
		$paymentStatus='Thành công';
	}
	$note=$order->getNote();
	if($note){
		$service_= _db()->getEntity('service.service');
		$service_->loadWhere(array('id',$note));
		$note= $service_->getServiceName();
	}
	$activeUser=$order->getActiveUser();
	$status=$order->getStatus();
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
 	<p align="center"> <strong>HOÁ ĐƠN <?php echo $id ?></strong></p>
 	<p align="center"><strong>(Ngày : <?php echo $orderDate ?> - trạng thái hoá đơn: <?php echo $status ?>)</strong></p>
 </div>
 <table id="admin_table_list" class="table table-hover">
 	
 
 <tr>
  <th>userId: <?php echo $userId ?></th>
  <th>username: <?php echo $username ?></th>
  <th>Tên: <?php echo $name ?></th>
  <th>Điện thoại: <?php echo $phone ?></th>  
 </tr>
 <tr>
 	<th colspan="2">Địa chỉ: <?php echo $address ?></th>
 	<th colspan="2">Đặt mua thẻ Nextnobels: <?php echo $note ?></th>
 </tr>
 <tr>  
  <th>Mã dịch vụ: <?php echo $serviceId ?></th>
  <th>Tên dịch vụ: <?php echo $serviceName ?></th>
  <th>Số lượng: <?php echo $quantity ?></th>
  <th>Tổng tiền: <?php echo $amount ?></th>  
 </tr>
 <tr>  
  <th>Hình thức thanh toán: <?php echo $paymentType ?></th>
  <th>Ngân hàng: <?php echo $bank ?></th>
  <th>Trạng thái thanh toán: <?php echo $paymentStatus ?></th>
  <th>Trạng thái hoá đơn: <?php echo $status ?></th>  
 </tr>
 <tr>
 	<th colspan="4" style="padding-left: 400px;" >
 		<a class="btn btn-primary" href="<?php echo BASE_REQUEST . '/admin_order/edit' ?>/<?php echo $id ?>">Sửa</a>
 		<a class="btn btn-primary" href="<?php echo BASE_REQUEST . '/admin_order/index' ?>">Trở lại</a>
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
 	<p align="center"> <strong>CHI TIẾT HOÁ ĐƠN <?php echo $id ?></strong></p>
 	
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
 <?php foreach($orderships as $item): ?>
 <?php 
 	$i++; 
 	$enttService->loadWhere(array('id',$item['serviceId']));
 ?>
 <tr>
 	<th><?php echo $i ?></th>
  <th><?php echo @$item['serviceId']?></th>
  <th>{enttService.getServiceName()} </th>
  <th><?php echo @$item['serviceType']?></th>
  <th><?php echo @$item['quantity']?></th>
  <th><?php echo @$item['price']?></th>  
  <th><?php echo @$item['amount']?></th>
 </tr>
 <?php endforeach; ?>
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
 	<p align="center"> <strong>CHI TIẾT HOÁ ĐƠN <?php echo $id ?></strong></p>
 	
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
 <?php foreach($orderships as $item): ?>
 <?php 
 	$i++; 
 	$enttService->loadWhere(array('id',$item['serviceId']));
 ?>
 <tr>
 	<th><?php echo $i ?></th>
  <th><?php echo @$item['serviceId']?></th>
  <th>{enttService.getServiceName()} </th>
  <th><?php echo @$item['quantity']?></th>
  <th><?php echo @$item['price']?></th>  
  <th><?php echo @$item['amount']?></th>
 </tr>
 <?php endforeach; ?>
 </table>
</div>
<?php } ?>	
