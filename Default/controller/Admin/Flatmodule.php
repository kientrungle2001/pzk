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
		// $this->removeField($fieldSettings, 'global');
	}
	
	public function alterListFieldSettings(&$fieldSettings) {
		$this->removeField($fieldSettings, 'xml')
			->removeField($fieldSettings, 'page')
			->removeField($fieldSettings, 'script')
			->removeField($fieldSettings, 'created')
			->removeField($fieldSettings, 'modified')
			->removeField($fieldSettings, 'creatorId')
			->removeField($fieldSettings, 'modifiedId');
	}
	
	public function getFilterFields () { 
		return PzkFilterConstant::gets('positionOfModule', 'flat_module');
	}
}