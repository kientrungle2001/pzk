<?php
class PzkAdminSocialaccountController extends PzkGridAdminController {
    public $addFields = 'appId, name, type, tokenId, parentId';
    public $editFields = 'appId, name, type, tokenId, parentId';
    public $table = 'social_account';
	public $joins = array(
		array(
			'table'	=> 'social_app',
			'condition'	=> 'social_account.appId = social_app.id',
			'type'	=> 'left'
		),
		array(
			'table' => '`admin` as `creator`',
			'condition' => 'social_account.creatorId = creator.id',
			'type' => 'left'
		),
		array(
			'table' => '`admin` as `modifier`',
			'condition' => 'social_account.modifiedId = modifier.id',
			'type' => 'left'
		),
	);
	public $selectFields = 'social_account.*, social_app.name as appName, creator.name as creatorName, modifier.name as modifiedName';
	public $orderBy = 'social_account.id asc';
    public $filterStatus = true;
	public $logable = true;
	public $logFields = 'appId, name, type, tokenId, parentId';
    public $sortFields = array(
        'social_account.id asc' => 'ID tăng',
        'social_account.id desc' => 'ID giảm',
        'social_account.name asc' => 'Tên tăng',
        'social_account.name desc' => 'Tên giảm',
    	'social_account.created asc' => 'Ngày tạo tăng',
    	'social_account.created desc' => 'Ngày tạo giảm',
    );
    public $searchFields = array('name');
    public $Searchlabels = 'Tên tài khoản';
    public $listFieldSettings = array(
        array(
            'index' => 'name',
            'type' => 'text',
            'label' => 'Tên tài khoản'
        ),
		array(
            'index' => 'type',
            'type' => 'text',
            'label' => 'Loại tài khoản'
        ),
		array(
            'index' => 'appName',
            'type' => 'text',
            'label' => 'Tên ứng dụng'
        ),
		array(
            'index' => 'created',
            'type' => 'datetime',
			'format' => 'd/m/Y H:i',
            'label' => 'Ngày tạo'
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
	
    public $addLabel = 'Thêm tài khoản';
    public $addFieldSettings = array(
        array(
            'index' => 'name',
            'type' => 'text',
            'label' => 'Tên tài khoản',
        ),
        array(
            'index' => 'appId',
            'type' => 'select',
			'table'	=> 'social_app',
			'show_value'	=> 'id',
			'show_name'	=> 'name',
            'label' => 'Ứng dụng'
        ),
		array(
            'index' => 'type',
            'type' => 'text',
            'label' => 'Loại tài khoản'
        ),
		array(
            'index' => 'tokenId',
            'type' => 'text',
            'label' => 'Mã tài khoản'
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
            'index' => 'appId',
            'type' => 'select',
			'table'	=> 'social_app',
			'show_value'	=> 'id',
			'show_name'	=> 'name',
            'label' => 'Ứng dụng'
        ),
		array(
            'index' => 'type',
            'type' => 'text',
            'label' => 'Loại tài khoản'
        ),
		array(
            'index' => 'tokenId',
            'type' => 'text',
            'label' => 'Mã tài khoản'
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