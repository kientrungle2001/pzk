<?php
class PzkAdminNewsletterController extends PzkGridAdminController {
	public $title = 'Quản lý Thư báo';
	public $table = 'newsletter_newsletter';
	public $joins = array(
		array(
			'table'		=> 	'`admin` as c',
			'condition'	=>	'newsletter_newsletter.creatorId = c.id',
			'type'		=> ''
		),
		array(
			'table'		=> 	'`admin` as m',
			'condition'	=>	'newsletter_newsletter.modifiedId = m.id',
			'type'		=> JOIN_TYPE_LEFT
		)
	);
	public $selectFields = 'newsletter_newsletter.*, c.name as creator, m.name as modifier';
	public $addFields = 'code,subject, body,url, status';
	public $editFields = 'code,subject, body,url, status';
	public $logable = true;
	public $logFields = 'code,subject, body,url, status';
	public $sortFields = array(
		'id asc' => 'ID tăng',
		'id desc' => 'ID giảm',
		'code asc' => 'code tăng',
		'code desc' => 'code giảm',
		'subject asc' => 'Tiêu đề tăng',
		'subject desc' => 'Tiêu đề giảm',
	);
	
	public $listFieldSettings = array(
		array(
            'index' => 'subject',
            'type' => 'text',
            'label' => 'Tiêu đề',
			'link'	=> '/admin_newsletter/edit/'
        ),
		array(
            'index' => 'code',
            'type' => 'text',
            'label' => 'Mã code'
        ),
        array(
            'index' => 'url',
            'type' => 'text',
            'label' => 'Đường dẫn'
        ),
		
		array(
			'index'	=> 'creator',
			'type'	=> 'text',
			'label'	=> 'Người tạo'
		),
		array(
			'index'	=> 'created',
			'type'	=> 'datetime',
			'label'	=> 'Ngày tạo',
			'format'=> 'd/m/Y H:i'
		),
		array(
			'index'	=> 'modifier',
			'type'	=> 'text',
			'label'	=> 'Người sửa'
		),
		array(
			'index'	=> 'modified',
			'type'	=> 'datetime',
			'label'	=> 'Ngày sửa',
			'format'=> 'd/m/Y H:i'
		),
		array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'Đã gửi'
        ),
	);
    public $addLabel = 'Thêm Thư Báo';
    public $addFieldSettings = array(
        array(
            'index' => 'code',
            'type' => 'text',
            'label' => 'Mã thư báo',
        ),
        array(
            'index' => 'url',
            'type' => 'text',
            'label' => 'Đường dẫn template'
        ),
        array(
            'index' => 'subject',
            'type' => 'text',
            'label' => 'Tiêu đề',
        ),
        array(
            'index' => 'body',
            'type' => 'tinymce',
            'label' => 'Nội dung'
        ),
        array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'Đã gửi'
        )
    );
    public $editFieldSettings = array(
        array(
            'index' => 'code',
            'type' => 'text',
            'label' => 'Mã thư báo',
        ),
        array(
            'index' => 'url',
            'type' => 'text',
            'label' => 'Đường dẫn template'
        ),
        array(
            'index' => 'subject',
            'type' => 'text',
            'label' => 'Tiêu đề',
        ),
        array(
            'index' => 'body',
            'type' => 'tinymce',
            'label' => 'Nội dung'
        ),
        array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'Đã gửi'
        )
    );
}
	
?>