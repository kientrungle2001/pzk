<?php 

/**
* 
*/
class PzkEcommerceServiceService extends PzkObject
{
    public $scriptable = true;
    public $layout = "service/service";
  public function loadUserName($member)
  {
    $user=_db()->useCB()->select('user.name as name, user.username as username,user.id as userid, user.avatar as avatar')->from('user')->where(array('id',$member))->result_one();
    //$sql="select `user`.name as 'name' ,`user`.username as 'username' ,`user`.id as 'id',`user`.avatar as 'avatar'  FROM `user` WHERE `user`.id = '".$member."'";
    //$user= _db()->query($sql);
    return $user;

  }
  public function loadService()
  {
      $arr= array();
      $service=_db()->useCB()
              ->select('service_packages. *')
              ->from('service_packages')
              ->where(array('status',1))
              ->where(array('software', pzk_request('softwareId')))
              ->where(array('site',pzk_request('siteId')))
              ->result();
      //$service=_db()->useCB()->select('user.id as id,user.username as username, friend.userfriend as userfriend')->from('friend')->leftjoin('user','friend.username=user.username')->where(array(array('column','user','id'),'99'))->result();
      foreach ($service as $arr_s) {
        $arr[$arr_s['id']]=$arr_s;
      }
      return $arr; 
  }             
  public function loadDiscount()
  {	  $date= date("Y-m-d H:i:s");
      $arr= array();
      $discount=_db()->useCB()->select('service_policy. *')
      ->from('service_policy')
      ->where(array('status',1))
      ->where(array('lte','startDate',$date))
      ->where(array('gte','endDate',$date))
      ->where(array('software', pzk_request('softwareId')))
      ->where(array('site',pzk_request('siteId')))
      ->result();
      foreach ($discount as $arr_d) 
      {
        $arr[$arr_d['serviceId']]=$arr_d;
      }
      return $arr; 
  }
 
	public function getSubject()
  {
    $subject=_db()->useCache(1800)->select("*")->from("categories")->whereParent(47)->whereStatus(1)->whereDisplay(1)->orderBy('ordering asc')->result();
    return($subject);
  }
}
 ?>