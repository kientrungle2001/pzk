<?php
class PzkAdminSocialScheduleClickController extends PzkGridAdminController {
	public $table = 'social_schedule_click';
	public $joins = array(
		array(
			'table'		=> 	'social_schedule',
			'condition'	=>	'social_schedule_click.scheduleId = social_schedule.id',
			'type'		=> 'left'
		),
		array(
			'table'		=> 	'news',
			'condition'	=>	'social_schedule.id = news.id',
			'type'		=> 'left'
		)
	);
	public $selectFields = 'social_schedule_click.*, news.title as newsTitle';
	public $sortFields = array(
		'social_schedule_click.id asc' => 'ID tăng',
		'social_schedule_click.id desc' => 'ID giảm',
		'social_schedule_click.time asc' => 'code tăng',
		'social_schedule_click.time desc' => 'code giảm',
	);
	
	public $listFieldSettings = array(
		array(
            'index' => 'newsTitle',
            'type' => 'text',
            'label' => 'Tên tin tức'
        ),
		array(
            'index' => 'scheduleId',
            'type' => 'text',
            'label' => 'Id lịch đăng tường'
        ),
        array(
            'index' => 'time',
            'type' => 'text',
            'label' => 'Thời gian'
        ),
		array(
            'index' => 'ip',
            'type' => 'text',
            'label' => 'IP'
        )
	);
    
}
	
?>