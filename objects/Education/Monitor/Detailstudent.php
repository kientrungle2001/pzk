<?php 
class PzkEducationMonitorDetailstudent extends PzkObject
{
	public function getUserById($id) {
		$user =_db()->useCache(1800)->select('*')->from('user')->where(array('id',$id))->result_one();
		return $user;
	}
}
?>