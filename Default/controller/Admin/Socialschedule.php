<?php
class PzkAdminSocialscheduleController extends PzkGridAdminController {
    public $addFields = 'type, newsId, published, accountId, status, recurable, recuring, postId';
    public $editFields = 'type, newsId, published, accountId, status, recurable, recuring, postId';
    public $table = 'social_schedule';
	public $logable = true;
	public $logFields = 'type, newsId, published, accountId, status, recurable, recuring, postId';
	public $joins = array(
		array(
			'table'		=> 	'news',
			'condition'	=> 	'social_schedule.newsId = news.id',
			'type'		=> ''
		),
		array(
			'table'		=> 	'social_account',
			'condition'	=> 	'social_schedule.accountId = social_account.id',
			'type'		=> 'left'
		),
		array(
			'table'		=> 	'social_app',
			'condition'	=> 	'social_account.appId = social_app.id',
			'type'		=> 'left'
		),
		array(
			'table' => '`admin` as `creator`',
			'condition' => 'social_schedule.creatorId = creator.id',
			'type' => 'left'
		),
		array(
			'table' => '`admin` as `modifier`',
			'condition' => 'social_schedule.modifiedId = modifier.id',
			'type' => 'left'
		),
	);
	public $selectFields = 'social_schedule.*, 
	news.title as name, 
	social_app.name as appName,
	social_app.type as type,
	social_account.name as accountName,
	social_account.type as accountType,
	creator.name as creatorName, modifier.name as modifiedName';
    public $filterStatus = true;

    public $sortFields = array(
        'id asc' => 'ID tăng',
        'id desc' => 'ID giảm',
        'name asc' => 'Tên tăng',
        'name desc' => 'Tên giảm',
    	'created asc' => 'Ngày tạo tăng',
    	'created desc' => 'Ngày tạo giảm',
    );
    public $searchFields = array('name');
    public $Searchlabels = 'Tên ứng dụng';
    public $listFieldSettings = array(
        array(
            'index' => 'type',
            'type' => 'text',
            'label' => 'Loại ứng dụng'
        ),
		array(
            'index' => 'accountType',
            'type' => 'text',
            'label' => 'Loại tài khoản'
        ),
		array(
            'index' => 'appName',
            'type' => 'text',
            'label' => 'Ứng dụng'
        ),
		array(
            'index' => 'accountName',
            'type' => 'text',
            'label' => 'Tài khoản'
        ),
		array(
            'index' => 'name',
            'type' => 'text',
            'label' => 'Tin tức'
        ),
		array(
            'index' => 'published',
            'type' => 'datetime',
			'format' => 'd/m/Y H:i',
            'label' => 'Ngày gửi'
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
	
    public $addLabel = 'Thêm lịch gửi';
    public $addFieldSettings = array(
        array(
            'index' => 'newsId',
            'type' => 'select',
			'table'	=> 'news',
			'show_value'	=> 'id',
			'show_name'		=> 'title',
            'label' => 'Tên tin tức',
        ),
        array(
            'index' => 'accountId',
            'type' => 'select',
			'table'	=> 'social_account',
			'show_value'	=> 'id',
			'show_name'		=> 'name',
            'label' => 'Profile'
        ),
		array(
            'index' => 'published',
            'type' => 'datetimepicker',
            'label' => 'Ngày xuất bản'
        ),

        array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'Trạng thái'
        )
    );
    public $editFieldSettings = array(
        array(
            'index' => 'newsId',
            'type' => 'select',
			'table'	=> 'news',
			'show_value'	=> 'id',
			'show_name'		=> 'title',
            'label' => 'Tên tin tức',
        ),
        array(
            'index' => 'accountId',
            'type' => 'select',
			'table'	=> 'social_account',
			'show_value'	=> 'id',
			'show_name'		=> 'name',
            'label' => 'Profile'
        ),
		array(
            'index' => 'published',
            'type' => 'datetimepicker',
            'label' => 'Ngày xuất bản'
        ),

        array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'Trạng thái'
        )
    );

}
?>
