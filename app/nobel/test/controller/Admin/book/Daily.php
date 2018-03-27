<?php
class PzkAdminBookDailyController extends PzkReportController
{
    public $titleController ='Báo cáo người làm bài theo ngày';
    public $table = 'user_book';
	public $selectFields = 'COUNT(*) AS userCount, date_format(startTime, "%m/%d") as startTimeDate' ;
	public $listFieldSettings = array(
        array(
			'index' => 'startTimeDate',
			'label' => 'Ngày'
		),
		array(
            'index' => 'userCount',
            'label' => 'Số người đăng ký'
        )
    );
	public $groupByReport = array(
		array(
            'index' => 'date_format(startTime, "%m/%d")',
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
        'subtitle' => 'Ngày',
        'titley' => 'Số người đăng ký'
    );
	
	public $showchart = true;
	public $displayReport = array(
        'show' => 'startTimeDate',
        'data' => 'userCount'
    );
}