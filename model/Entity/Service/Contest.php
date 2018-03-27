<?php 
/**
* 
*/
class PzkEntityServiceContestModel extends PzkEntityModel
{
	public $table="contest";
  //check thoi gian dien ra cuoc thi
	function checkContestTime(){
      $date= date('Y-m-d');
      $query= _db()->select('count(*) as total')
              -> from($this->table)
              -> where(array('lte','beginDate',$date))
              -> where(array('gte','expiredDate',$date))
              ->result_one();
      if($query['total']>0){
        return 1;
      }
      return 0;
  }
  //check thoi gian hien thi ket qua
  function checkResultTime(){
      $date= date('Y-m-d');
      $query= _db()->select('count(*) as total')
              -> from($this->table)
              -> where(array('lte','showResultDate',$date))
              -> where(array('gte','expiredDate',$date))
              ->result_one();
      if($query['total']>0){
        return 1;
      }
      return 0;
  }
}
 ?>