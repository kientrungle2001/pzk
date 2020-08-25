<?php
class PzkAdminContestController extends PzkGridAdminController {
    public $table = 'user_contest';
    public $addFields = 'userId, camp, mark, teacherMark,totalMark,duringTime,modifiedId, status, createdId,software';
    public $editFields = 'userId, camp, mark, teacherMark,totalMark,duringTime,modifiedId, status,createdId,software';
    public $sortFields = array(
        'id asc' => 'ID tăng',
        'id desc' => 'ID giảm'
    );
	
	public $joins = array(
			array(
					'table' => 'user',
					'condition' => 'user_contest.userId = user.id',
					'type' =>''
			)
		);

	public $selectFields = 'user_contest.*, user.username as username, user.name as name';
	
    public $listFieldSettings = array(
        
        array(
            'index' => 'userId',
            'type' => 'nameid',
            'table' => 'user',
            'showField' => 'username',
            'findField' => 'id',
            'label' => 'Tên đăng nhập'
        ),
		array(
            'index' => 'name',
            'type' => 'text',
            'label' => 'Ho ten'
        ),
		array(
            'index' => 'mark',
            'type' => 'text',
            'label' => 'Số câu làm đúng trắc nghiệm'
        ),
		
		array(
            'index' => 'teacherMark',
            'type' => 'text',
            'label' => 'Điểm bài tự luận'
        ),
		array(
            'index' => 'totalMark',
            'type' => 'text',
            'label' => 'Tổn điểm 2 bài'
        ),
        array(
            'index' => 'camp',
            'type' => 'text',
            'label' => 'Đợt thi'
        ),
		array(
            'index' => 'duringTime',
            'type' => 'text',
            'label' => 'thời gian làm bài'
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
	//search fields co type la text
    public $searchFields = array('username', '`user_contest`.`id`');
    public $searchLabel = 'Tên';

    public $filterFields = array(
		array(
            'index' 		=> 'camp',
            'type' 			=> 'selectoption',
            'label' 		=> 'Đợt thi',
            'option' 		=> array(
				1 	=> "Đợt 1",
                2 		=> "Đợt 2",
                
			)
        ),
		array(
            'index' 		=> 'parentTest',
            'type' 			=> 'selectoption',
            'label' 		=> 'Khối thi',
            'option' 		=> array(
				145 	=> "Khối 2",
                142		=> "Khối 3",
				 139 		=> "Khối 4",
				  133 		=> "Khối 5",
                
			)
        )
	);
}

?>