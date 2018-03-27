<?php
require_once(BASE_DIR . '/3rdparty/simpletest/autorun.php');
		
class PzkTestcaseTestController extends UnitTestCase {
	public function indexAction() {
		
	}
	
	public function testAdminModel() {
		$adminModel = pzk_model('Admin');
		$result = $adminModel->login('huunv90', '1234567');
		$this->assertFalse($result);
		
		$result = $adminModel->login('huunv90', '12345678');
		$this->assertTrue($result !== false);
	}
}