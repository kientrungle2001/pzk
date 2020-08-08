<?php 
class PzkServiceController extends PzkFrontendController 
{
	public $masterPage='index';
	public $masterPosition='left';


	public function serviceAction() 
	{
		$this->layout();
		$this->append('service/service');
		$this->append('user/profile/profileuser','right');
		$this->display();
	
	}
	public function BuyServiceAction()
	{
		$opt_service= pzk_request()->getOpt_service_type();
		$opt_service= explode(" ",$opt_service);
		$opt_service_id= $opt_service[0];
		$price= $opt_service[1];
		
		$price= trim($price);
		$price=(double)$price;
		$datetime=date("Y-m-d H:i:s");
		$wallets=_db()->getEntity('user.account.wallets');
		$wallets->loadWhere(array('username',pzk_session('username')));
		$amount=$wallets->getAmount();
		if($price < $amount)
		{
			// cập nhật database

			$amount= $amount- $price;
			$wallets->update(array('amount'=>$amount));
			$insert=_db()->getEntity('service.history_buyservice');
			$row=array('userId'=>pzk_session('userId'), 'serviceId'=>$opt_service_id, 'amount'=>$price, 'date'=>$datetime);
			$insert->setData($row);
			$insert->save();
			echo 1;

		}
		else echo 0;

	}
	public function ordercardAction() 
	{
		$this->layout();
		$this->append('service/ordercard');
		$this->append('user/profile/profileuser','right');
		$this->display();
	
	}
	public function OrderCardNexnobelsAction()
	{
		
		$ordercard_txtname= pzk_request()->getOrdercard_txtname();
		$ordercard_txtphone= pzk_request()->getOrdercard_txtphone();
		$ordercard_txtaddress= pzk_request()->getOrdercard_txtaddress();
		$ordercard_quantity= pzk_request()->getOrdercard_quantity();
		$ordercard_quantity= (int)$ordercard_quantity;
		$ordercard_selectcard= pzk_request()->getOrdercard_selectcard();
		$opt_service= explode(" ",$ordercard_selectcard);
		$opt_service_id= $opt_service[0];
		$price= $opt_service[1];
		if($ordercard_quantity >=1){
			$price=$price*$ordercard_quantity;
		}else $ordercard_quantity=1;
		
		$price= trim($price);
		$price=(double)$price;
		$datetime=date("Y-m-d H:i:s");
		$ordercard=_db()->getEntity('service.order_card');
		$row=array('cardId'=>$opt_service_id,'fullname'=>$ordercard_txtname,'phone'=>$ordercard_txtphone, 'address'=>$ordercard_txtaddress,'quantity'=>$ordercard_quantity, 'amount'=>$price, 'date'=>$datetime);
		$ordercard->setData($row);
		$ordercard->save();
		echo 1;
	}
}
 ?>