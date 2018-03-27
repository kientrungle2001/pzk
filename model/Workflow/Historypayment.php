<?php
class PzkWorkflowHistorypaymentModel {
	public function cancel($entity, $value) {
		
	}
	public function active($entity, $value) {
		$entity->set('paymentstatus', '1');
		$entity->save();
	}
}