<?php
class PzkAdminSlideshowController extends PzkGridAdminController {
	public $table = 'slideshow';
	public $searchFields = array('name');
    public $searchLabel = 'Tên';
	public $listFieldSettings = array(
        array(
            'index' => 'name',
            'type' => 'text',
            'label' => 'Slideshow'
        ),
		array(
            'index' => 'height',
            'type' => 'text',
            'label' => 'Chiều cao'
        ),
		array(
            'index' => 'width',
            'type' => 'text',
            'label' => 'Chiều rộng'
        ),
        array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'Trạng thái'
        )
    );
	public $addLabel = "Thêm slideshow";
	public $addFields = 'name, width, height, status, software, global, sharedSoftwares, site';
	public $addFieldSettings = array(
		array(
			'index' => 'name',
			'type' => 'text',
			'label' => "Tên"
		),
		array(
			'index' => 'width',
			'type' => 'text',
			'label' => "Chiều rộng"
		),
		array(
			'index' => 'height',
			'type' => 'text',
			'label' => "Chiều cao"
		),
		array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'Trạng thái',
			'mdsize'	=> 3
        ),
		array(
            'index' => 'global',
            'type' => 'status',
            'label' => 'Global',
            'options' => array(
                '0' => 'Không hoạt động',
                '1' => 'Hoạt động'
            ),
            'actions' => array(
                '0' => 'mở',
                '1' => 'dừng'
            ),
			'mdsize'		=> 2
        ),
		array(
			'index' => 'sharedSoftwares',
			'type' => 'multiselectoption',
			'option' => array(
				1 => "Full Look",
                2 => "IQ, EQ, CQ",
                3 => "Luyện viết văn",
				4 => "Trang chủ",
				6 => "Olympic",
				7 => "Thi tài",
				8 => "Thi tài Next Nobels"
			),
			'label' => 'Chia sẻ'
		)
	);
	public $addValidator = array(
        'rules' => array(
            'name' => array(
                'required' => true,
                'minlength' => 1,
                'maxlength' => 50
            ),
            
        ),
        'messages' => array(
            'name' => array(
                'required' => 'Tên nhóm không được để trống',
                'minlength' => 'Tên nhóm phải dài 1 ký tự trở lên',
                'maxlength' => 'Tên nhóm chỉ dài tối đa 50 ký tự'
            ),
            

        )
    );
	public $editLabel = "Sửa slideshow";
	public $editFields = 'name, width, height, status, software, global, sharedSoftwares, site';
	public $editFieldSettings = array(
		array(
			'index' => 'name',
			'type' => 'text',
			'label' => "Tên"
		),
		array(
			'index' => 'width',
			'type' => 'text',
			'label' => "Chiều rộng"
		),
		array(
			'index' => 'height',
			'type' => 'text',
			'label' => "Chiều cao"
		),
		array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'Trạng thái',
			'mdsize'	=> 3
        ),
		array(
            'index' => 'global',
            'type' => 'status',
            'label' => 'Global',
            'options' => array(
                '0' => 'Không hoạt động',
                '1' => 'Hoạt động'
            ),
            'actions' => array(
                '0' => 'mở',
                '1' => 'dừng'
            ),
			'mdsize'		=> 2
        ),
		array(
			'index' => 'sharedSoftwares',
			'type' => 'multiselectoption',
			'option' => array(
				1 => "Full Look",
                2 => "IQ, EQ, CQ",
                3 => "Luyện viết văn",
				4 => "Trang chủ",
				6 => "Olympic",
				7 => "Thi tài",
				8 => "Thi tài Next Nobels"
			),
			'label' => 'Chia sẻ'
		)
	);
    
    public $editValidator = array(
        'rules' => array(
            'name' => array(
                'required' => true,
                'minlength' => 1,
                'maxlength' => 50
            ),
            

        ),
        'messages' => array(
            'name' => array(
                'required' => 'Tên nhóm không được để trống',
                'minlength' => 'Tên nhóm phải dài 1 ký tự trở lên',
                'maxlength' => 'Tên nhóm chỉ dài tối đa 50 ký tự'
            ),
            
        )
    );
}
?>