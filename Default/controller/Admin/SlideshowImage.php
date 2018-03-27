<?php
class PzkAdminSlideshowImageController extends PzkGridAdminController {
	public $table = 'slideshow_images';
	public $searchFields = array('name');
    public $Searchlabels = 'Tên';
	public $listFieldSettings = array(
        array(
            'index' => 'name',
            'type' => 'text',
            'label' => 'ảnh'
        ),
		array(
            'label' 	=> "Slider show",
			'index' 	=> "slideshowId",
			'type' 		=> "nameid",
			'table' 	=> 'slideshow',
			'findField' => 'id',
			'showField' => 'name',
        ),
		array(
			'index' 	=> 'ordering',
			'type' 		=> 'ordering',
			'label' 	=> 'Thứ tự'
		),
        array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'Trạng thái'
        )
    );
	public $addLabel = "Thêm ảnh";
	public $addFields = 'name, image_vn, ordering, image, brief, additionalScript, link, slideshowId, status, software, global, sharedSoftwares, site';
	public $addFieldSettings = array(
		array(
			'index' => 'name',
			'type' => 'text',
			'label' => "Tên"
		),
		array(
			'index' => 'ordering',
			'type' => 'text',
			'label' => "Odering",
			'mdsize'	=> 3
		),
		array(
			'index' => 'image',
			'type' => 'filemanager',
			'label' => "Ảnh",
			'mdsize'	=> 3
		),
		array(
			'index' => 'image_vn',
			'type' => 'filemanager',
			'label' => "Ảnh Tiếng Việt",
			'mdsize'	=> 3
		),
		array(
			'index' => 'slideshowId',
			'type' => "select",
			'label' => "Chọn slider",
			'table' => "slideshow",
			'show_value' => "id",
			'show_name' => 'name',
			'mdsize'	=> 3
		),
		array(
			'index' => 'link',
			'type' => 'text',
			'label' => "Link"
		),
		array(
			'index' => 'brief',
			'type' => 'tinymce',
			'label' => "Brief"
		),
		array(
			'index' => 'additionalScript',
			'type' => 'tinymce',
			'label' => "Script"
			
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
	public $editLabel = "Sửa ảnh";
	public $editFields = 'name, image_vn, ordering, image, brief, additionalScript, link, slideshowId, status, software, global, sharedSoftwares, site';
	public $editFieldSettings = array(
		array(
			'index' => 'name',
			'type' => 'text',
			'label' => "Tên"
		),
		
		array(
			'index' => 'ordering',
			'type' => 'text',
			'label' => "Odering",
			'mdsize'	=> 3
		),
		array(
			'index' => 'image',
			'type' => 'filemanager',
			'label' => "Ảnh",
			'mdsize'	=> 3
		),
		array(
			'index' => 'image_vn',
			'type' => 'filemanager',
			'label' => "Ảnh Tiếng Việt",
			'mdsize'	=> 3
		),
		array(
			'index' => 'slideshowId',
			'type' => "select",
			'label' => "Chọn slider",
			'table' => "slideshow",
			'show_value' => "id",
			'show_name' => 'name',
			'mdsize'	=> 3
		),
		array(
			'index' => 'link',
			'type' => 'text',
			'label' => "Link"
		),
		array(
			'index' => 'brief',
			'type' => 'tinymce',
			'label' => "Brief"
		),
		array(
			'index' => 'additionalScript',
			'type' => 'tinymce',
			'label' => "Script"
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