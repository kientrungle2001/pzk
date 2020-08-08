<?php 
class PzkServiceController extends PzkFrontendController 
{
	public $masterPage='index';
	public $masterPosition='left';
	public function serviceAction() 
	{
		$this->layout();
		$this->append('payment/left')->append('service/service');
		$this->display();
	}
	public function BuyServiceAction()
	{
		$service= pzk_request()->getService();
		$ids= $service['id'];
		$total=0;

		foreach ($ids as $price) {
			$total=$total+$price;
		}

		$datetime=date("Y-m-d H:i:s");
		$userId=pzk_session()->getUserId();
		$wallets=_db()->getEntity('user.account.wallets');
		$wallets->loadWhere(array('userId',$userId));
		if($wallets->getId()){
			$amount=$wallets->getAmount();
			if($total < $amount){
				// cập nhật database
				$amount= $amount- $total;
				$quantity= count($ids);
				$wallets->update(array('amount'=>$amount));
				$order=_db()->getEntity('service.order');
				$row=array('userId'=>pzk_session()->getUserId(),'username'=>pzk_session()->getUsername(),'paymentType'=>'wallets_buyservice','software'=>'3','quantity'=>$quantity,'amount'=>$total,'orderDate'=>$datetime,'paymentStatus'=>1,'status'=>1);				
				$order->setData($row);
				$order->save();
				$orderId= $order->getId();
				//Cập nhật bảng order_item history_service
				$orderitem=_db()->getEntity('service.orderitem');
				$model = pzk_model('Transaction');
				$message=_db()->getEntity('user.NewMessage');
				foreach ($ids as $id => $price) {
					$row_item=array('orderId'=>$orderId,'serviceId'=>$id,'price'=>$price,'quantity'=>1,'amount'=>$price,'status'=>1);
					$orderitem->setData($row_item);
					$orderitem->save();	
					$model->buyService($userId,$id,'wallets_buyservice');
					// insert table new_message
					$mess=array('userId'=>pzk_session()->getUserId(),'messageType'=>'payservice','serviceId'=>$id,'date'=>date("Y-m-d H:i:s"),'status'=>0);
					
					$message->create($mess);			
				}
				$transaction=_db()->getEntity('payment.transaction');
				$row_=array('orderId'=>$orderId,'userId'=>pzk_session()->getUserId(),'username'=>pzk_session()->getUsername(),'paymentType'=>'wallets','amount'=>$total,'paymentDate'=>$datetime,'reason'=>'mua goi dich vu','status'=>1);		
				$transaction->setData($row_);			
				$transaction->save();
				echo 1;
			}else echo 0;			
		}else echo 0;

	}
	
	public function ordercardAction() 
	{
		$this->layout();
		$this->append('payment/left')->append('service/ordercard');
		$this->display();
	}
	public function OrderCardPAction()
	{	
		$txtname= pzk_request()->getTxtname();
		$txtphone= pzk_request()->getTxtphone();
		$txtaddress= pzk_request()->getTxtaddress();
		$quantity= pzk_request()->getQuantity();
		if($txtname=='' ||$txtphone=='' ||$txtaddress=='' ||$quantity=='' || !is_numeric($txtphone)|| !is_numeric($quantity)  ){
			
			return false;
		}
		
		$selectcard= pzk_request()->getSelectcard();
		$opt_service= explode(" ",$selectcard);
		$opt_service_id= $opt_service[0];
		$price= $opt_service[1];
		$serviceType=$opt_service[2];
		if($quantity >=1){
			$price=$price*$quantity;
		}
		$price= trim($price);
		$price=(double)$price;
		$datetime=date("Y-m-d H:i:s");
		$ordercard=_db()->getEntity('service.order');
		$row=array('name'=>$txtname,'phone'=>$txtphone,'note'=>$opt_service_id, 'address'=>$txtaddress,'quantity'=>$quantity,'software'=>'3','amount'=>$price,'paymentType'=>'datmuathe','orderDate'=>$datetime);
		$ordercard->setData($row);		
		$ordercard->save();
		$orderId=$ordercard->getId();
		$shipping=_db()->getEntity('service.ordershipping');
		$rowship=array('orderId'=>$orderId ,'name'=>$txtname,'phone'=>$txtphone,'address'=>$txtaddress,'serviceId'=>$opt_service_id,'serviceType'=>$serviceType,'quantity'=>$quantity,'price'=>$opt_service[1],'amount'=>$price,'status'=>1);
		$shipping->setData($rowship);	
		$shipping->save();
		$mess=array('userId'=>pzk_session()->getUserId(),'messageType'=>'ordercard','serviceId'=>$opt_service_id,'date'=>date("Y-m-d H:i:s"),'status'=>0);
		$newmessage= _db()->getEntity('user.NewMessage');
		$newmessage->create($mess);
		echo 1;
	}
}
 ?>