<?php
class PzkAdminOrderItemController extends PzkGridAdminController {
    public $addFields = 'orderId,serviceId,quantity,price,amount,status';
    public $editFields = 'orderId,serviceId,quantity,price,amount,status';
    public $table='order_item';
    public $joins = array(
        array(
            'table' => 'service_packages',
            'condition' => 'service_packages.id = order_item.serviceId',
            'type' =>''
        )
    );
    public $selectFields = 'order_item.*,service_packages.serviceName as serviceName, service_packages.serviceType as serviceType';
    
    public $sortFields = array(
        'id asc' => 'ID tăng',
        'id desc' => 'ID giảm',
        'orderId asc' => 'orderId tăng',
        'orderId desc' => 'orderId giảm',
        
    );
    public $searchFields = array('orderId','serviceName');
    
    public $listFieldSettings = array(
        
        array(
            'index' => 'orderId',
            'type' => 'text',
            'label' => 'Mã hoá đơn '
        ),
        
        array(
            'index' => 'serviceName',
            'type' => 'text',
            'label' => 'Tên dịch vụ '
        ),
        array(
            'index' => 'serviceType',
            'type' => 'text',
            'label' => 'Loại dịch vụ'
        ),
        array(
            'index' => 'quantity',
            'type' => 'text',
            'label' => 'Số lượng '
        ),
        array(
            'index' => 'price',
            'type' => 'text',
            'label' => 'Đơn giá '
        ),
        array(
            'index' => 'amount',
            'type' => 'text',
            'label' => 'Tổng tiền '
        ),
        array(
            'index' => 'status',
            'type' => 'text',
            'label' => 'Trạng thái '
        )
    );
    public $addLabel = 'Thêm';
    public $addFieldSettings = array(
        array(
            'index' => 'orderId',
            'type' => 'text',
            'label' => 'Mã hoá đơn'
        ),
        
        array(
            'index' => 'serviceId',
            'type' => 'select',
            'table'=>'service_packages',
            'show_value'=>'id',
            'show_name'=>'serviceName',
            'label' => 'Dịch vụ'
        ),
        array(
            'index' => 'quantity',
            'type' => 'text',
            'label' => 'Số lượng'
        ),
        array(
            'index' => 'price',
            'type' => 'text',
            'label' => 'Đơn giá'
        ),
        array(
            'index' => 'amount',
            'type' => 'text',
            'label' => 'Tổng tiền'
        ),
        array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'Trạng thái'
        )
    );
    public $editFieldSettings = array(
        array(
            'index' => 'orderId',
            'type' => 'text',
            'label' => 'Mã hoá đơn'
        ),
        
        array(
            'index' => 'serviceId',
            'type' => 'select',
            'table'=>'service_packages',
            'show_value'=>'id',
            'show_name'=>'serviceName',
            'label' => 'Dịch vụ'
        ),
        array(
            'index' => 'quantity',
            'type' => 'text',
            'label' => 'Số lượng'
        ),
        array(
            'index' => 'price',
            'type' => 'text',
            'label' => 'Đơn giá'
        ),
        array(
            'index' => 'amount',
            'type' => 'text',
            'label' => 'Tổng tiền'
        ),
        array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'Trạng thái'
        )
    );
    
    
}