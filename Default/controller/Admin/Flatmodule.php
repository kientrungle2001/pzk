<?php
class PzkAdminFlatmoduleController extends PzkGridAdminController {
	public $table = 'flat_module';
	public function alterAddFieldSettings(&$fieldSettings) {
		$this->alterEditFieldSettings($fieldSettings);
	}
	public function alterEditFieldSettings(&$fieldSettings) {
		$this->alterField($fieldSettings, array(
			'xml' => array(
				'type'	=> 'textarea'
			),
			'script' => array(
				'type'	=> 'textarea'
			)
		));
	}
	
}