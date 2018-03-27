<?php
class PzkAdminGametypeController extends PzkGridAdminController {

    public $titleController = 'Các loại trò chơi';
    public $table = 'game_type';
    public $listFieldSettings = array(

        array(
            'index' => 'game_type',
            'type' => 'text',
            'label' => 'Loại trò chơi'
        ),
        array(
            'index' => 'gamecode',
            'type' => 'text',
            'label' => 'Mã kiểu trò chơi'
        ),
		array(
            'index' => 'vocabulary',
            'type' => 'status',
            'label' => 'Từ vựng',
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

    public $searchFields = array('game_type');
    public $Searchlabels = 'Loại trò chơi';

    public $addFields = 'game_type, status, userId, gamecode, vocabulary, createdId, modifiedId, software';
    public $addLabel = 'Thêm Loại trò chơi';

    public $addFieldSettings = array(
        array(
            'index' => 'game_type',
            'type' => 'text',
            'label' => 'Loại trò chơi'
        ),
        array(
            'index' => 'gamecode',
            'type' => 'text',
            'label' => 'Mã kiểu trò chơi'
        ),
		array(
            'index' => 'vocabulary',
            'type' => 'status',
            'label' => 'Từ vựng',
            'options' => array(
                '0' => 'Không hoạt động',
                '1' => 'Hoạt động'
            ),
            'actions' => array(
                '0' => 'mở',
                '1' => 'dừng'
            )
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
            'game_type' => array(
                'required' => true,
                'minlength' => 2,
                'maxlength' => 1000
            )
        ),
        'messages' => array(
            'game_type' => array(
                'required' => 'Tên loại trò chơi không được để trống',
                'minlength' => 'Tên loại trò chơi phải dài 2 ký tự trở lên',
                'maxlength' => 'Tên loại trò chơi chỉ dài tối đa 255 ký tự'
            )
        )
    );

    public $editLabel = 'Sửa loại trò chơi';
    public $editFields = 'game_type, status, userId, gamecode, vocabulary, createdId, modifiedId, software';

    public $editFieldSettings = array(
        array(
            'index' => 'game_type',
            'type' => 'text',
            'label' => 'Loại trò chơi'
        ),
        array(
            'index' => 'gamecode',
            'type' => 'text',
            'label' => 'Mã kiểu trò chơi'
        ),
		array(
            'index' => 'vocabulary',
            'type' => 'status',
            'label' => 'Từ vựng',
            'options' => array(
                '0' => 'Không hoạt động',
                '1' => 'Hoạt động'
            ),
            'actions' => array(
                '0' => 'mở',
                '1' => 'dừng'
            )
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

    public $editValidator = array(
        'rules' => array(
            'game_type' => array(
                'required' => true,
                'minlength' => 2,
                'maxlength' => 50
            )
        ),
        'messages' => array(
            'game_type' => array(
                'required' => 'Loại trò chơi không được để trống',
                'minlength' => 'Loại trò chơi phải dài 2 ký tự trở lên',
                'maxlength' => 'Loại trò chơi chỉ dài tối đa 50 ký tự'
            )
        )

    );
}