<?php

class PzkAdminReportController extends PzkReportController
{
    public $table = 'orders';
    public $joins = array(
        array(
            'table' => 'shippers',
            'condition' => 'orders.shipper_id = shippers.shipper_id',
            'type' => ''
        )
    );
    public $selectFields = 'shippers.shipper_name, COUNT(orders.shipper_id) AS NumberOfOrders, SUM(orders.money) as total' ;
    public $groupByReport = array(
        array(
            'index' => 'shippers.shipper_id',
        )

    );
    public $listFieldSettings = array(
        array(
            'index' => 'shipper_name',
            'label' => 'Tên nguoi ship'
        ),
        array(
            'index' => 'NumberOfOrders',
            'label' => 'Tong so order'
        ),
        array(
            'index' => 'total',
            'label' => 'tong tien'
        )
    );

    //export data
    public $exportFields = array('shipper_name', 'NumberOfOrders', 'total');
    public $exportTypes = array('pdf', 'excel', 'csv');

    //search fields co type la text
    public $searchFields = array('shipper_name');
    public $Searchlabels = 'Tên';
    //sort by
    public $sortFields = array(
        'total asc' => 'total tăng',
        'total desc' => 'total giảm',

    );

    public $showchart = true;
    public $displayReport = array(
        'show' => 'shipper_name',
        'data' => 'NumberOfOrders'
    );
    //public $having = 'NumberOfOrders > 1';

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
        'subtitle' => 'Số đơn hàng của một shipper',
        'titley' => 'Số đơn hàng'
    );


}

?>