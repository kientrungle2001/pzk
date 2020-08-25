<?php
class PzkOrderModel {
	public function changeStatus($orderEntity, $newStatus) {
		
			$orderId=$orderEntity->getId();
			$serviceId= $orderEntity->getServiceId();
			$userId= $orderEntity->getUserId();
			$model = pzk_model('Transaction');
			if($orderId !=0 && $serviceId !=0 && $userId !=0){
				$model->denyService($userId,$serviceId,$orderId,$newStatus);
			}else{
				$model->Change($orderId,$newStatus);  
			}     
                     
	}
}