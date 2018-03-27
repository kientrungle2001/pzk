<?php
class PzkAdminGameController extends PzkGridAdminController {
    public $table = 'game';
    public $addFields = 'gamecode, game_topic_id,question,dataword,datatrue,status,modifiedId,userId,createdId,software, datetimepicker, datepicker';
    public $editFields = 'gamecode, game_topic_id,question,dataword,datatrue,status,modifiedId,userId,createdId,software, datetimepicker, datepicker';
	public $logable = true;
	public $logFields = 'gamecode, game_topic_id,question,dataword,datatrue,status,modifiedId,userId,createdId,software, datetimepicker, datepicker';
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
            'type' => 'tinymce',
            'label' => 'Yêu cầu'
        ),
        array(
            'index' => 'datepicker',
            'type' => 'datepicker',
            'label' => 'Yêu cầu1'
        ),
        array(
            'index' => 'datetimepicker',
            'type' => 'datetimepicker',
            'label' => 'Yêu cầu2'
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
                'maxlength' => 255
            )
        ),
        'messages' => array(
            'question' => array(
                'required' => 'Yêu cầu chơi không được để trống',
                'minlength' => 'Yêu cầu ít nhất phải từ hai ký tự',
                'maxlength' => 'Yêu cầu tối đa 255 ký tự'
            )
        )
    );
    public $editValidator = array(
        'rules' => array(
            'question' => array(
                'required' => true,
                'minlength' => 2,
                'maxlength' => 255
            )
        ),
        'messages' => array(
            'question' => array(
                'required' => 'Loại trò chơi không được để trống',
                'minlength' => 'Yêu cầu ít nhất phải từ hai ký tự',
                'maxlength' => 'Yêu cầu tối đa 255 ký tự'
            )
        )
    );
}

?>