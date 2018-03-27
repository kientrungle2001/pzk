<?php
class PzkAdminOrderShippingController extends PzkGridAdminController {
    public $addFields = 'orderId, name, address,phone,serviceId,serviceType,quantity,price,amount,status';
    public $editFields = 'orderId, name, address,phone,serviceId,serviceType,quantity,price,amount,status';
    public $table='order_shipping';
    public $joins = array(
        array(
            'table' => 'service_packages',
            'condition' => 'service_packages.id = order_shipping.serviceId',
            'type' =>''
        )
    );
    public $selectFields = 'order_shipping.*,service_packages.serviceName as serviceName, service_packages.amount as price';
    
    public $sortFields = array(
        'id asc' => 'ID tăng',
        'id desc' => 'ID giảm',
        'orderId asc' => 'orderId tăng',
        'orderId desc' => 'orderId giảm',
        'name asc' => 'name tăng',
        'name desc' => 'name giảm',
        'phone asc' => 'phone tăng',
        'phone desc' => 'phone giảm',        
        'address asc' => 'address tăng',
        'address desc' => 'address giảm'
    );
    public $searchFields = array('orderId','serviceName', 'phone', 'name','address');
    
    public $listFieldSettings = array(
        
        array(
            'index' => 'orderId',
            'type' => 'text',
            'label' => 'Mã hoá đơn '
        ),
        array(
            'index' => 'name',
            'type' => 'text',
            'label' => 'Tên khách hàng'
        ),
        array(
            'index' => 'address',
            'type' => 'text',
            'label' => 'Địa chỉ '
        ),
        array(
            'index' => 'phone',
            'type' => 'text',
            'label' => 'Điện thoại '
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
            'index' => 'name',
            'type' => 'text',
            'label' => 'Tên '
        ),
        array(
            'index' => 'address',
            'type' => 'text',
            'label' => 'Địa chỉ '
        ),
        array(
            'index' => 'phone',
            'type' => 'text',
            'label' => 'Điện thoại'
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
        )
    );
    public $editFieldSettings = array(
        array(
            'index' => 'orderId',
            'type' => 'select',
            'label' => 'Mã hoá đơn',
            'table'=>'order',
            'show_value'=>'id',
            'show_name'=>'id',
            
        ),
        array(
            'index' => 'name',
            'type' => 'text',
            'label' => 'Tên '
        ),
        array(
            'index' => 'address',
            'type' => 'text',
            'label' => 'Địa chỉ '
        ),
        array(
            'index' => 'phone',
            'type' => 'text',
            'label' => 'Điện thoại'
        ),
        array(
            'index' => 'serviceId',
            'type' => 'text',
            'label' => 'Dịch vụ',
            'table'=>'service_packages',
            'show_value'=>'id',
            'show_name'=>'serviceName',
            
            /*'index' => 'serviceId',
            'type' => 'select',
            'table'=>'service_packages',
            'show_value'=>'id',
            'show_name'=>'serviceName',
            'label' => 'Dịch vụ'*/
        ),
        array(
            'index' => 'quantity',
            'type' => 'text',
            'label' => 'Số lượng'
        ),
        array(
            'index' => 'amount',
            'type' => 'text',
            'label' => 'Tổng tiền'
        )
    );
    public $addValidator = array(
        'rules' => array(
            'orderId' => array(
                'required' => true
            ),
            'name' => array(
                'required' => true
               
            ),
            'address' => array(
                'required' => true
            ),
            'phone' => array(
                'required' => true
               
            ),
            'serviceId' => array(
                'required' => true
            ),
            'quantity' => array(
                'required' => true               
            ),
            'amount' => array(
                'required' => true               
            )

        ),
        'messages' => array(
            'orderId' => array(
                'required' => 'orderId không được để trống'
                
            ),
            'name' => array(
                'required' => 'name không được để trống'
                
            ),
            'address' => array(
                'required' => 'address không được để trống'
                
            ),
            'phone' => array(
                'required' => 'phone không được để trống'
                
            ),
            'serviceId' => array(
                'required' => 'serviceId không được để trống'
                
            ),
            'quantity' => array(
                'required' => 'quantity không được để trống'
                
            ),
            'amount' => array(
                'required' => 'amount không được để trống'                
            )
        )
    );
    public $editValidator = array(
        'rules' => array(
            'orderId' => array(
                'required' => true
            ),
            'name' => array(
                'required' => true
               
            ),
            'address' => array(
                'required' => true
            ),
            'phone' => array(
                'required' => true
               
            ),
            'serviceId' => array(
                'required' => true
            ),
            'quantity' => array(
                'required' => true               
            ),
            'amount' => array(
                'required' => true               
            )

        ),
        'messages' => array(
            'orderId' => array(
                'required' => 'orderId không được để trống'
                
            ),
            'name' => array(
                'required' => 'name không được để trống'
                
            ),
            'address' => array(
                'required' => 'address không được để trống'
                
            ),
            'phone' => array(
                'required' => 'phone không được để trống'
                
            ),
            'serviceId' => array(
                'required' => 'serviceId không được để trống'
                
            ),
            'quantity' => array(
                'required' => 'quantity không được để trống'
                
            ),
            'amount' => array(
                'required' => 'amount không được để trống'                
            )
        )
    );
    
}