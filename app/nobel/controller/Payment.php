<?php 
class PzkPaymentController extends PzkController 
{
	public $masterPage='index';
	public $masterPosition='left';

	
	public function bankAction()
	{
		$this->layout();
		$this->append('payment/bank','left');
		$this->display();
			
	}
	
	public function bank2Action()
	{
		$this->layout();
		$this->append('payment/bank2','left');
	
		$this->display();
		//$this->render('user/payment/payment');
	}
	
}
 ?>