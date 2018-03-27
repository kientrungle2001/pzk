<?php
class PzkAdminGametopicController extends PzkGridAdminController {

    public $titleController = 'Các chủ đề';
    public $table = 'game_topic';
    public $listSettingType = 'parent';
    public $listFieldSettings = array(
        array(
            'index' => 'game_topic',
            'type' => 'parent',
            'label' => 'Chủ đề'
        )
    );

    public $searchFields = array('game_topic');
    public $Searchlabels = 'Chủ đề';

    public $addFields = 'game_topic, parent, status, userId, createdId, modifiedId, software';
    public $addLabel = 'Thêm chủ đề';

    public $addFieldSettings = array(
        array(
            'index' => 'game_topic',
            'type' => 'text',
            'label' => 'Chủ đề'
        ),
        array (
					'index' => 'parent',
					'type' => 'select',
					'table' => 'game_topic',
					'label' => 'Danh mục cha',
					'show_name' => 'game_topic',
					'show_value' => 'id'
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
            'game_topic' => array(
                'required' => true,
                'minlength' => 2,
                'maxlength' => 1000
            )
        ),
        'messages' => array(
            'game_topic' => array(
                'required' => 'Tên chủ đề không được để trống',
                'minlength' => 'Tên chủ đề phải dài 2 ký tự trở lên',
                'maxlength' => 'Tên chủ đề chỉ dài tối đa 255 ký tự'
            )
        )
    );

    public $editLabel = 'Sửa chủ đề';
    public $editFields = 'game_topic, parent, status, userId, createdId, modifiedId, software';

    public $editFieldSettings = array(
        array(
            'index' => 'game_topic',
            'type' => 'text',
            'label' => 'Chủ đề'
        ),
        array (
            'index' => 'parent',
            'type' => 'select',
            'table' => 'game_topic',
            'label' => 'Danh mục cha',
            'show_name' => 'game_topic',
            'show_value' => 'id'
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
            'game_topic' => array(
                'required' => true,
                'minlength' => 2,
                'maxlength' => 50
            )
        ),
        'messages' => array(
            'game_topic' => array(
                'required' => 'Tên chủ đề không được để trống',
                'minlength' => 'Tên chủ đề phải dài 2 ký tự trở lên',
                'maxlength' => 'Tên chủ đề chỉ dài tối đa 50 ký tự'
            )
        )

    );
}