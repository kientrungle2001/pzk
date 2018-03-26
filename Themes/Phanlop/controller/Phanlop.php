<?php 
class PzkPhanlopController extends PzkController 
{
	public $masterPage		=	'index';
	public $masterPosition	=	'wrapper';


	public function lopAction() 
	{
		pzk_session('lop', pzk_request('lop'));
		//check payment		
		$fullModel = pzk_model('Service.Full');
		$checkPayment= $fullModel->checkPayment('full');
		pzk_session('checkPayment',$checkPayment);
	}
	
}