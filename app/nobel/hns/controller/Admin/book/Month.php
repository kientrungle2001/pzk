<?php
class PzkAdminBookMonthController extends PzkReportController
{
    public $titleController ='Báo cáo người đăng ký';
    public $table = 'user_book';
	public $selectFields = 'COUNT(*) AS userCount, concat(month(startTime) , "/", year(startTime)) as createdMonth' ;
	public $listFieldSettings = array(
        array(
			'index' => 'createdMonth',
			'label' => 'Tháng'
		),
		array(
            'index' => 'userCount',
            'label' => 'Số người đăng ký'
        )
    );
	public $groupByReport = array(
		array(
            'index' => 'concat(month(startTime) , "/", year(startTime))',
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
        'subtitle' => 'Tháng',
        'titley' => 'Số người đăng ký theo tháng'
    );
	
	public $showchart = true;
	public $displayReport = array(
        'show' => 'createdMonth',
        'data' => 'userCount'
    );
}