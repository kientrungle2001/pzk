<?php
class PzkAdminSocialappController extends PzkGridAdminController {
    public $title = 'Ứng dụng mạng xã hội';
	public $addFields = 'name, type, appId, appSecret,userloginId,status';
    public $editFields = 'name, type, appId, appSecret,userloginId,status';
    public $table = 'social_app';
    public $filterStatus = true;
	public $quickMode = false;
	public $logable = true;
	public $logFields = 'name, type, appId, appSecret,userloginId,status';
    public $sortFields = array(
        'social_app.id asc' => 'ID tăng',
        'social_app.id desc' => 'ID giảm',
        'social_app.name asc' => 'Tên tăng',
        'social_app.name desc' => 'Tên giảm',
    	'social_app.type asc' => 'Loại tăng',
        'social_app.type desc' => 'Loại giảm',
		'social_app.created asc' => 'Ngày tạo tăng',
    	'social_app.created desc' => 'Ngày tạo giảm',
    );
	public $orderBy = 'social_app.id asc';
    public $searchFields = array('name');
    public $Searchlabels = 'Tên ứng dụng';
	public $joins = array(
		array(
			'table' => '`admin` as `creator`',
			'condition' => 'social_app.creatorId = creator.id',
			'type' => JOIN_TYPE_LEFT
		),
		array(
			'table' => '`admin` as `modifier`',
			'condition' => 'social_app.modifiedId = modifier.id',
			'type' => JOIN_TYPE_LEFT
		),
	);
	public $selectFields = 'social_app.*, creator.name as creatorName, modifier.name as modifiedName';
    public $listFieldSettings = array(
        array(
            'index' => 'name',
            'type' => 'text',
            'label' => 'Tên ứng dụng'
        ),
		array(
            'index' => 'type',
            'type' => 'text',
            'label' => 'Loại ứng dụng'
        ),
		array(
            'index' => 'appId',
            'type' => 'text',
            'label' => 'ID ứng dụng'
        ),
		array(
            'index' => 'appSecret',
            'type' => 'text',
            'label' => 'Mã bảo mật'
        ),
        array(
            'index' => 'userloginId',
            'type' => 'text',
            'label' => 'Mã tài khoản đăng nhập app'
        ),
		array(
            'index' => 'none',
            'type' => 'link',
			'link' => '/admin_cron/facebook/',
            'label' => 'Xác thực'
        ),
        array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'Trạng thái'
        ),
		array(
			'index'	=> 'none4',
			'type'	=> 'group',
			'label'	=> '<br />Người tạo<br />Người sửa',
			'delimiter'	=> '<br />',
			'fields'	=> array(
				array(
					'index' => 'creatorName',
					'type' => 'text',
					'label' => 'Người tạo'
				),
				array(
					'index' => 'modifiedName',
					'type' => 'text',
					'label' => 'Người sửa'
				),
			)
		),
		array(
			'index'	=> 'none5',
			'type'	=> 'group',
			'label'	=> '<br />Ngày tạo<br />Ngày sửa',
			'delimiter'	=> '<br />',
			'fields'	=> array(
				array(
					'index' => 'created',
					'type' => 'datetime',
					'label' => 'Ngày tạo',
					'format'	=> 'H:i d/m'
				),
				array(
					'index' => 'modified',
					'type' => 'datetime',
					'label' => 'Ngày sửa',
					'format'	=> 'H:i d/m'
				),
			)
		),
    );
	
    public $addLabel = 'Thêm ứng dụng';
    public $addFieldSettings = array(
        array(
            'index' => 'name',
            'type' => 'text',
            'label' => 'Tên ứng dụng',
        ),
		array(
            'index' => 'type',
            'type' => 'selectoption',
            'label' => 'Loại ứng dụng',
			'option'	=> array(
				'facebook'		=> 'Facebook',
				'google'		=> 'Google',
				'twitter'		=> 'Twitter'
			)
        ),
        array(
            'index' => 'appId',
            'type' => 'text',
            'label' => 'ID ứng dụng'
        ),
		array(
            'index' => 'appSecret',
            'type' => 'text',
            'label' => 'Mã bảo mật'
        ),
        array(
            'index' => 'userloginId',
            'type' => 'text',
            'label' => 'Mã tài khoản đăng nhập app'
        ),
        array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'Trạng thái'
        )
    );
    public $editFieldSettings = array(
        array(
            'index' => 'name',
            'type' => 'text',
            'label' => 'Tên ứng dụng',
        ),
        array(
            'index' => 'type',
            'type' => 'selectoption',
            'label' => 'Loại ứng dụng',
			'option'	=> array(
				'facebook'		=> 'Facebook',
				'google'		=> 'Google',
				'twitter'		=> 'Twitter'
			)
        ),
		array(
            'index' => 'appId',
            'type' => 'text',
            'label' => 'ID ứng dụng'
        ),
		array(
            'index' => 'appSecret',
            'type' => 'text',
            'label' => 'Mã bảo mật'
        ),
        array(
            'index' => 'userloginId',
            'type' => 'text',
            'label' => 'Mã tài khoản đăng nhập app'
        ),
        array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'Trạng thái'
        )
    );
    public $addValidator = array(
        'rules' => array(
            'name' => array(
                'required' => true,
                'minlength' => 2,
                'maxlength' => 50
            )

        ),
        'messages' => array(
            'name' => array(
                'required' => 'Tên menu không được để trống',
                'minlength' => 'Tên menu phải dài 2 ký tự trở lên',
                'maxlength' => 'Tên menu chỉ dài tối đa 50 ký tự'
            )

        )
    );
    public $editValidator = array(
        'rules' => array(
            'name' => array(
                'required' => true,
                'minlength' => 2,
                'maxlength' => 50
            )

        ),
        'messages' => array(
            'name' => array(
                'required' => 'Tên menu không được để trống',
                'minlength' => 'Tên menu phải dài 2 ký tự trở lên',
                'maxlength' => 'Tên menu chỉ dài tối đa 50 ký tự'
            )

        )
    );

}
?>