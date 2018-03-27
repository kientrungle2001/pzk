<?php
class PzkAdminBookHourController extends PzkReportController
{
    public $titleController ='Báo cáo người làm bài theo giờ';
    public $table = 'user_book';
	public $selectFields = 'COUNT(*) AS userCount, date_format(startTime, "%H") as startTimeHour' ;
	public $listFieldSettings = array(
		array(
			'index' => 'startTimeHour',
			'label' => 'Giờ'
		),
		array(
            'index' => 'userCount',
            'label' => 'Số người đăng ký'
        )
    );
	public $groupByReport = array(
		array(
            'index' => 'date_format(startTime, "%H")',
        )
	);
	public $typeChart = array(
        array(
            'index' => 'Dạng cột',
            'value' => 'column'
        ),
        array(
            'index' => 'Dạng dòng',
            'value' => 'line'
        ),
        array(
            'index' => 'AREA',
            'value' => 'area'
        ),
        array(
            'index' => 'SPLINE',
            'value' => 'spline'
        ),
        array(
            'index' => 'Bar',
            'value' => 'bar'
        )
        //array(
        //    'index' => 'PIE',
        //    'value' => 'pie'
        //)
    );
	
	public $configChart = array(
        'title' => 'Báo cáo',
        'subtitle' => 'Giờ',
        'titley' => 'Số người đăng ký theo giờ'
    );
	
	public $showchart = true;
	public $displayReport = array(
        'show' => 'startTimeHour',
        'data' => 'userCount'
    );
}