<?php
require_once(BASE_DIR . '/3rdparty/simpletest/autorun.php');

class PzkTestcaseDatabaseController extends UnitTestCase {
	public function indexAction() {
		
	}
	function testDatabaseSelect() {
		
		$query = _db()->query('select count(*) as total from user');
		$query = $query[0];
		/*	Test Select All */
		$items = _db()->selectAll()->fromUser()->result();
		$this->assertEqual(count($items), $query['total']);
		
		$query = _db()->query('select count(*) as total from user where username like \'%kienle%\'');
		$query = $query[0];
		/*	Test Select Like */
		$items = _db()->selectAll()->fromUser()->likeUsername('%kienle%')->result();
		$this->assertEqual(count($items), $query['total']);
		
		$query = _db()->query('select count(*) as total from user where username = \'kienle\'');
		$query = $query[0];
		/*	Test Select Equal */
		$items = _db()->selectAll()->fromUser()->equalUsername('kienle')->result();
		$this->assertEqual(count($items), $query['total']);
		
		$query = _db()->query('select count(*) as total from user where id > 500');
		$query = $query[0];
		/*	Test Select Greater */
		$items = _db()->selectAll()->fromUser()->gtId('500')->result();
		$this->assertEqual(count($items), $query['total']);
		
		$query = _db()->query('select count(*) as total from user where id >= 500');
		$query = $query[0];
		/*	Test Select Greater or Equal */
		$items = _db()->selectAll()->fromUser()->gteId('500')->result();
		$this->assertEqual(count($items), $query['total']);
		
		
		$query = _db()->query('select count(*) as total from user where id in (500, 501, 502, 503, 504, 5000)');
		$query = $query[0];
		/*	Test Select In */
		$items = _db()->selectAll()->fromUser()->inId(array(500, 501, 502, 503, 504, 5000))->result();
		$this->assertEqual(count($items), $query['total']);
		
		
		$query = _db()->query('select count(*) as total from user where id < 100 and username like \'%kienle%\'');
		$query = $query[0];
		/*	Test Select Multiple Conditions */
		$items = _db()->selectAll()->fromUser()
				->likeUsername('%kienle%')
				->ltId(100)
				->result();
		$this->assertEqual(count($items), $query['total']);
		
		
		$query = _db()->query('select count(*) as total from user where id < 100 and username like \'%kienle%\' and status=0');
		$query = $query[0];
		/*	Test Select Multiple Conditions with Where Condition */
		$items = _db()->selectAll()->fromUser()
				->likeUsername('%kienle%')
				->ltId(100)
				->whereStatus(0)
				->result();
		$this->assertEqual(count($items), $query['total']);
		
		
		$query = _db()->query('select count(*) as total from user where id not in (500, 501, 502, 503, 504, 5000)');
		$query = $query[0];
		/*	Test Select With Not In */
		$items = _db()->selectAll()->fromUser()->notinId(array(500, 501, 502, 503, 504, 5000))->result();
		$this->assertEqual(count($items), $query['total']);
		
		
		$query = _db()->query('select count(*) as total from user where username not like \'%kienle%\'');
		$query = $query[0];
		/*	Test Select With Not Like */
		$items = _db()->selectAll()->fromUser()->nlikeUsername('%kienle%')->result();
		$this->assertEqual(count($items), $query['total']);
	}
	
	public function testInjection()	{
		$query = _db()->query('select count(*) as total from user where id=\'1 or 1=1\'');
		$query = $query[0];
		$items = _db()->selectAll()->fromUser()->whereId('1 or 1=1')->result();
		$this->assertEqual(count($items), $query['total']);
		
		$query = _db()->query('select count(*) as total from user where id in (\'1\', \'2) or (1=1\' )');
		$query = $query[0];
		$items = _db()->selectAll()->fromUser()->inId(array( '1', '2) or (1=1' ))->result();
		$this->assertEqual(count($items), $query['total']);
	}
}