<?php
class PzkAdminSiteSiteController extends PzkGridAdminController {
	public $table = 'site_site';
	public $addFields = 'name, domain';
	public $editFields = 'name, domain';
	public $sortFields = array(
		'id asc' => 'ID tăng',
		'id desc' => 'ID giảm',
		'name asc' => 'Tiêu đề tăng',
		'name desc' => 'Tiêu đề giảm'
	);
	
	public $listFieldSettings = array(
        array(
            'index' => 'name',
            'type' => 'text',
            'label' => 'Tiêu đề'
        ),		
			array(
					'index' => 'domain',
					'type' => 'text',
					'label' => 'Domain'
			),

	);
    public $addLabel = 'Thêm';
    public $addFieldSettings = array(
        array(
            'index' => 'name',
            'type' => 'text',
            'label' => 'Thêm Site',
        ),
    		array(
    				'index' => 'domain',
    				'type' => 'text',
    				'label' => 'Domain',
    		)
    );
    public $editFieldSettings = array(
        array(
            'index' => 'name',
            'type' => 'text',
            'label' => 'Tên Site',
        ),
    		array(
    				'index' => 'domain',
    				'type' => 'text',
    				'label' => 'Domain',
    		)
    );
	public $addValidator = array(
		'rules' => array(
			'name' => array(
				'required' => true,
				'minlength' => 2,
				'maxlength' => 255
			),
				'domain' => array(
						'required' => true,
						'minlength' => 2,
						'maxlength' => 255
				)
		),
		'messages' => array(
			'name' => array(
				'required' => 'Tên Site không được để trống',
				'minlength' => 'Tên Site phải từ hai ký tự trở lên',
				'maxlength' => 'Tên Site tối đa 255 ký tự'
			),
				'domain' => array(
						'required' => 'Tên Domain không được để trống',
						'minlength' => 'Tên Domain phải từ hai ký tự trở lên',
						'maxlength' => 'Tên Domain tối đa 255 ký tự'
				)
		)
	);
	public $editValidator = array(
		'rules' => array(
			'name' => array(
				'required' => true,
				'minlength' => 2,
				'maxlength' => 255
			),
				'domain' => array(
						'required' => true,
						'minlength' => 2,
						'maxlength' => 255
				)
		),
		'messages' => array(
			'name' => array(
				'required' => 'Tên bài viết không được để trống',
				'minlength' => 'Tên bài viết phải từ hai ký tự trở lên',
				'maxlength' => 'Tên bài viết tối đa 255 ký tự'
			),
				'domain' => array(
						'required' => 'Tên Domain không được để trống',
						'minlength' => 'Tên Domain phải từ hai ký tự trở lên',
						'maxlength' => 'Tên Domain tối đa 255 ký tự'
				)
		)
	);
}
	
?>