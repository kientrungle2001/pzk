<?php
class PzkAdminBookWeekdayController extends PzkReportController
{
    public $titleController ='Báo cáo người làm bài theo ngày trong tuần';
    public $table = 'user_book';
	public $selectFields = 'COUNT(*) AS userCount, date_format(startTime, "%w") as startTimeWeekday' ;
	public $listFieldSettings = array(
		array(
			'index' => 'startTimeWeekday',
			'label' => 'Thứ'
		),
		array(
            'index' => 'userCount',
            'label' => 'Số người đăng ký'
        )
    );
	public $groupByReport = array(
		array(
            'index' => 'date_format(startTime, "%w")',
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
        'subtitle' => 'Ngày trong tuần',
        'titley' => 'Số người đăng ký theo ngày trong tuần'
    );
	
	public $showchart = true;
	public $displayReport = array(
        'show' => 'startTimeWeekday',
        'data' => 'userCount'
    );
}