<?php
class PzkAdminGameRainwordController extends PzkGridAdminController {
	public $table = 'game_rainword';
	public $addFields = 'gametypeId,img,game_title,parent';
	public $editFields = 'gametypeId,img,game_title,parent';
	public $sortFields = array(
		'id asc' => 'ID tăng',
		'id desc' => 'ID giảm',
		'title asc' => 'Tiêu đề tăng',
		'title desc' => 'Tiêu đề giảm'
	);
	
	public $listFieldSettings = array(
        array(
            'index' => 'gametypeId',
            'type' => 'text',
            'label' => 'ID trò chơi'
        ),
		array(
            'index' => 'parent',
            'type' => 'text',
            'label' => 'Tên trò chơi cha'
        ),
		array(
            'index' => 'game_title',
            'type' => 'text',
            'label' => 'Trọng tâm trò chơi'
        ),
		array(
            'index' => 'img',
            'type' => 'text',
            'label' => 'Ảnh đại diện'
        )
	);
    public $addLabel = 'Thêm';
    public $addFieldSettings = array(
        array(
            'index' => 'gametypeId',
            'type' => 'text',
            'label' => 'ID trò chơi'
        ),

		array(
            'index' => 'img',
            'type' => 'upload',
            'uploadtype'=>'image',
            'label' => 'Chọn ảnh đại diện',
        ),
		array(
            'index' => 'game_title',
            'type' => 'text',
            'label' => 'Nhập trọng điểm miêu tả'
        ),
		array(
            'index' => 'parent',
            'type' => 'select',
            'label' => 'Menu cha',
            'table' => 'game_rainword',
            'show_value' => 'id',
            'show_name' => 'game_title'
        )	
    );
    public $editFieldSettings = array(
       array(
            'index' => 'gametypeId',
            'type' => 'text',
            'label' => 'Loại trò chơi'
        ),

		array(
            'index' => 'img',
            'type' => 'upload',
            'uploadtype'=>'image',
            'label' => 'Chọn ảnh đại diện',
        ),
		array(
            'index' => 'game_title',
            'type' => 'text',
            'label' => 'Nhập trọng điểm miêu tả'
        ),
		array(
            'index' => 'parent',
            'type' => 'select',
            'label' => 'Menu cha',
            'table' => 'game_rainword',
            'show_value' => 'id',
            'show_name' => 'game_title'
        )
		
    );
	public $addValidator = array(
		'rules' => array(
			'game_title' => array(
				'required' => true,
				'minlength' => 2,
				'maxlength' => 255
			)
		),
		'messages' => array(
			'game_title' => array(
				'required' => 'Tên trọng điểm không được để trống',
				'minlength' => 'Ít nhất phải từ hai ký tự',
				'maxlength' => 'Tối đa 255 ký tự'
			)
		)
	);
	public $editValidator = array(
		'rules' => array(
			'game_title' => array(
				'required' => true,
				'minlength' => 2,
				'maxlength' => 255
			)
		),
		'messages' => array(
			'game_title' => array(
				'required' => 'Tên trọng điểm không được để trống',
				'minlength' => 'Ít nhất phải từ hai ký tự',
				'maxlength' => 'Tối đa 255 ký tự'
			)
		)
	);
}
	
?>