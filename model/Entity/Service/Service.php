<?php 
/**
* 
*/
class PzkEntityServiceServiceModel extends PzkEntityModel
{
	public $table="service_packages";
	public function loadService()
  	{
      return _db()->useCB()->useCache(1800)->select('service_packages. *')
      ->from('service_packages')
      ->where(array('status',1))
      ->result('Service.Service');
  	}
  public function loadServiceTest()
    {
      return _db()->useCB()->select('service_packages. *')
      ->from('service_packages')
      ->where(array('status',1))
      // ->where(array('like', 'serviceType','%contest%'))
	  // ->where(array('gte', 'created', '2017'))
      ->result('Service.Service');
    }
  public function loadId($id)
    {
      return _db()->useCB()->select('service_packages. *')
      ->from('service_packages')
      ->where(array('id',$id))
      ->result_one('Service.Service');
    }
  	public function discount()
  	{	  
  		$date= date("Y-m-d H:i:s");
      $arr_discount= array();
      $discount=_db()->useCB()->select('service_policy. *')->from('service_policy')->where(array('status',1))->where(array('lte','startDate',$date))->where(array('gte','endDate',$date))->result();
      foreach ($discount as $arr_d) 
      {
        $arr_discount[$arr_d['serviceId']]=$arr_d;
      }
      return $arr_discount; 
  	}
}
 ?>