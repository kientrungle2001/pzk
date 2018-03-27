<?php
class PzkAdminAdvertisementController extends PzkGridAdminController {
    public $addFields = 'categoryId, urlImg, altImg, contentImg';
    public $editFields = 'categoryId, urlImg, altImg, contentImg';
    public $table = 'advertisement';
    public $sortFields = array(
        'id asc' => 'ID tăng',
        'id desc' => 'ID giảm',
        'categoryId asc' => 'categoryId tăng',
        'categoryId desc' => 'categoryId giảm',
    );
    public $searchFields = array('categoryId');
    public $listFieldSettings = array(
        array(
            'index' => 'categoryId',
            'type' => 'text',
            'label' => 'category Id'
        ),
        array(
            'index' => 'urlImg',
            'type' => 'image',
            'label' => 'Đường dẫn ảnh'
        ),
        array(
            'index' => 'altImg',
            'type' => 'text',
            'label' => 'alt Ảnh'
        ),
        array(
            'index' => 'contentImg',
            'type' => 'text',
            'label' => 'Nội dung ảnh'
        )

    );
	public $logable = true;
	public $logFields = 'urlImg, altImg, contentImg';
   public $addLabel = 'Thêm';
   public $addFieldSettings = array(
         array(
            'index' => 'categoryId',
            'type' => 'select',
            'label' => 'Menu cha',
            'table' => 'categories',
            'show_name' => 'name',
            'show_value' =>'id'
        ),
        array(
            'index' => 'urlImg',
            'type' => 'upload',
            'uploadtype'=>'image',
            'label' => 'Chọn ảnh',
        ),
        array(
            'index' => 'altImg',
            'type' => 'text',
            'label' => 'alt Ảnh'
        ),
        array(
            'index' => 'contentImg',
            'type' => 'text',
            'label' => 'Nội dung ảnh'
        )

    );

    public $editFieldSettings = array(
         array(
            'index' => 'categoryId',
            'type' => 'select',
            'label' => 'Danh mục',
            'table' => 'categories',
            'show_name' => 'name',
            'show_value' =>'id'
        ),
        array(
            'index' => 'urlImg',
            'type' => 'upload',
            'uploadtype'=>'image',
            'label' => 'Chọn ảnh',
        ),
        array(
            'index' => 'altImg',
            'type' => 'text',
            'label' => 'alt Ảnh'
        ),
        array(
            'index' => 'contentImg',
            'type' => 'text',
            'label' => 'Nội dung ảnh'
        )
    );
    
}
?>