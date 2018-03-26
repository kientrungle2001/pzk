<?php 
/**
* 
*/
class PzkCommunicationInvitationInvitation extends PzkObject
{
	public $scriptable=true;
	public function loadUserName($member)
	{
		$user=_db()->useCB()->select('user.name as name, user.username as username,user.id as userid, user.avatar as avatar')->from('user')->where(array('id',$member))->result_one();
		//return $user;
		if(!$user['name']){
			return $user['username'];
		}else return $user['name'];

	}
}
 ?>