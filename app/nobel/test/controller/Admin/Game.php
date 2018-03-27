<?php
class PzkAdminGameController extends PzkGridAdminController {
    public $table = 'game';
    public $addFields = 'gamecode, game_topic_id,question,dataword,datatrue,status,modifiedId,userId, documentId, createdId,software';
    public $editFields = 'gamecode, game_topic_id,question,dataword,datatrue,status,modifiedId,userId, documentId, createdId,software';
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
            'index' => 'gamecode',
            'type' => 'nameid',
            'table' => 'game_type',
            'showField' => 'game_type',
            'findField' => 'gamecode',
            'label' => 'Loại trò chơi'
        ),
		array(
            'index' => 'documentId',
            'type' => 'nameid',
            'table' => 'document',
            'showField' => 'title',
            'findField' => 'id',
            'label' => 'Tên tài liệu'
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
	public $filterFields = array(	
		array(
				'index'			=>'documentId',
				'type' 			=> 'select',
				'label' 		=> 'Lọc theo tài liệu',
				'table' 		=> 'document',
				'show_value' 	=> 'id',
				'show_name' 	=> 'title',
				'condition'		=> 'type like \'%vocabulary%\'',
		),
		array(
				'index'			=>'gamecode',
				'type' 			=> 'selectoption',
				'label' 		=> 'Chọn loại game',
				'option' 		=> array(
					'vmt' 			=> 'Mưa từ theo ảnh',
					'vdrag' 			=> 'Kéo từ vào chủ đề',
					'vdragimg' 			=> 'Kéo từ vào ảnh',
					'vdt' => 'Điền từ theo loa đọc',
					'sortword' => 'Sắp xếp từ',
					'muatu' => 'Game mưa từ',
					'dragWord' => 'Game kéo từ'
				),
		)
	);
    public $addLabel = 'Thêm';
    public $addFieldSettings = array(
        array(
            'index' => 'question',
            'type' => 'tinymce',
            'label' => 'Yêu cầu'
        ),
        array(
            'index' => 'gamecode',
            'type' => 'select',
            'label' => 'Chọn loại game',
            'table' => 'game_type',
            'show_name' => 'game_type',
            'show_value' =>'gamecode'

        ),
		array (
            'index' => 'documentId',
            'type' => 'select',
            'table' => 'document',
            'label' => 'Chọn tài liệu',
            'show_name' => 'title',
            'show_value' => 'id',
			'condition'		=> 'type like \'%vocabulary%\'',
        ),
        array (
            'index' => 'game_topic_id',
            'type' => 'select',
            'table' => 'game_topic',
            'label' => 'Chọn chủ đề',
            'show_name' => 'game_topic',
            'show_value' => 'id'
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
            'type' => 'tinymce',
            'label' => 'Yêu cầu'
        ),
        array(
            'index' => 'gamecode',
            'type' => 'select',
            'label' => 'Chọn chủ đề',
            'table' => 'game_type',
            'show_name' => 'game_type',
            'show_value' =>'gamecode'

        ),
		array (
            'index' => 'documentId',
            'type' => 'select',
            'table' => 'document',
            'label' => 'Chọn tài liệu',
            'show_name' => 'title',
            'show_value' => 'id',
			'condition'		=> 'type like \'%vocabulary%\'',
        ),
        array (
            'index' => 'game_topic_id',
            'type' => 'select',
            'table' => 'game_topic',
            'label' => 'Chọn loại game',
            'show_name' => 'game_topic',
            'show_value' => 'id'
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
                
            )
        ),
        'messages' => array(
            'question' => array(
                'required' => 'Yêu cầu chơi không được để trống',
                'minlength' => 'Yêu cầu ít nhất phải từ hai ký tự',
                
            )
        )
    );
    public $editValidator = array(
        'rules' => array(
            'question' => array(
                'required' => true,
                'minlength' => 2,
               
            )
        ),
        'messages' => array(
            'question' => array(
                'required' => 'Loại trò chơi không được để trống',
                'minlength' => 'Yêu cầu ít nhất phải từ hai ký tự',
                
            )
        )
    );
}

?>