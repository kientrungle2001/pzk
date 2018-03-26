<?php 

class PzkMarketingScheduleSocial extends PzkObject
{
	public function loadApp(){
		//load app
		$apps=_db()->useCB()->select('social_app.*')->from('social_app')->where(array('status',1))->where(array('type','facebook'))->result();
		return $apps;
	}
	public function loadSchedule(){
		//load Schedule
		$schedules=_db()->useCB()->select('social_schedule.newsId as newsId, social_schedule.published as published,social_schedule.recurable as recurable,news.brief as brief,news.title as title,news.alias as alias')->from('social_schedule')->join('news', 'news.id = social_schedule.newsId', 'left')->result();
		return $schedules;
	}
	public function updateLog($scheduleId){
		$log= _db()->getEntity('Schedule.Log');
		$date= date('Y-m-d H:i:s');
		$row= array('scheduleId'=>$scheduleId, 'message'=>'','status'=>1,'created'=>$date);
		$log->setData($row);
		$log->save();
	}
}
 ?>