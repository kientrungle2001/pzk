<?php
class PzkAdminGameController extends PzkGridAdminController {
	public $table = 'game';
	public $addFields = 'game_type_id,game_topic_id,linkgame,question,dataword,datatrue,status,modifiedId,userId,createdId,software';
	public $editFields = 'game_type_id,game_topic_id,linkgame,question,dataword,datatrue,status,modifiedId,userId,createdId,software';
	public $sortFields = array(
		'id asc' => 'ID tăng',
		'id desc' => 'ID giảm'
	);
	
	public $listFieldSettings = array(
        array(
            'index' => 'question',
            'type' => 'text',
            'label' => 'Yêu cầu'
        ),
        array(
            'index' => 'game_type_id',
            'type' => 'nameid',
            'table' => 'game_type',
            'showField' => 'game_type',
            'findField' => 'id',
            'label' => 'Loại trò chơi'
        ),
        array(
            'index' => 'game_topic_id',
            'type' => 'nameid',
            'table' => 'game_topic',
            'showField' => 'game_topic',
            'findField' => 'id',
            'label' => 'Chủ đề'
        ),
        array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'Trạng thái',
            'options' => array(
                '0' => 'Không hoạt động',
                '1' => 'Hoạt động'
            ),
            'actions' => array(
                '0' => 'mở',
                '1' => 'dừng'
            )
        )
		
		

	);
    public $addLabel = 'Thêm';
    public $addFieldSettings = array(
        array(
            'index' => 'question',
            'type' => 'text',
            'label' => 'Yêu cầu'
        ),
        array(
            'index' => 'game_type_id',
            'type' => 'select',
            'label' => 'Menu cha',
            'table' => 'game_type',
            'show_name' => 'game_type',
            'show_value' =>'id'

        ),
        array(
            'index' => 'linkgame',
            'type' => 'text',
            'label' => 'Link trò chơi'
        ),
        array(
            'index' => 'game_topic_id',
            'type' => 'select',
            'label' => 'Menu cha',
            'table' => 'game_topic',
            'show_name' => 'game_topic',
            'show_value' =>'id'
        ),
        array(
            'index' => 'dataword',
            'type' => 'text',
            'label' => 'Các từ'
        ),
        array(
            'index' => 'datatrue',
            'type' => 'text',
            'label' => 'Các từ đúng'
        ),
        array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'Trạng thái',
            'options' => array(
                '0' => 'Không hoạt động',
                '1' => 'Hoạt động'
            ),
            'actions' => array(
                '0' => 'mở',
                '1' => 'dừng'
            )
        )


    );
    public $editFieldSettings = array(
        array(
            'index' => 'question',
            'type' => 'text',
            'label' => 'Yêu cầu'
        ),
        array(
            'index' => 'game_type_id',
            'type' => 'select',
            'label' => 'Menu cha',
            'table' => 'game_type',
            'show_name' => 'game_type',
            'show_value' =>'id'

        ),
        array(
            'index' => 'linkgame',
            'type' => 'text',
            'label' => 'Link trò chơi'
        ),
        array(
            'index' => 'game_topic_id',
            'type' => 'select',
            'label' => 'Menu cha',
            'table' => 'game_topic',
            'show_name' => 'game_topic',
            'show_value' =>'id'
        ),
        array(
            'index' => 'dataword',
            'type' => 'text',
            'label' => 'Các từ'
        ),
        array(
            'index' => 'datatrue',
            'type' => 'text',
            'label' => 'Các từ đúng'
        ),
        array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'Trạng thái',
            'options' => array(
                '0' => 'Không hoạt động',
                '1' => 'Hoạt động'
            ),
            'actions' => array(
                '0' => 'mở',
                '1' => 'dừng'
            )
        )


    );
	public $addValidator = array(
		'rules' => array(
			'question' => array(
				'required' => true,
				'minlength' => 2,
				'maxlength' => 255
			)
		),
		'messages' => array(
			'queston' => array(
				'required' => 'Yêu cầu chơi không được để trống',
				'minlength' => 'Yêu cầu ít nhất phải từ hai ký tự',
				'maxlength' => 'Yêu cầu tối đa 255 ký tự'
			)
		)
	);
	public $editValidator = array(
		'rules' => array(
			'queston' => array(
				'required' => true,
				'minlength' => 2,
				'maxlength' => 255
			)
		),
		'messages' => array(
			'queston' => array(
				'required' => 'Loại trò chơi không được để trống',
				'minlength' => 'Yêu cầu ít nhất phải từ hai ký tự',
				'maxlength' => 'Yêu cầu tối đa 255 ký tự'
			)
		)
	);
}
	
?>