<?php
class PzkAdminTuvanController extends PzkGridAdminController {
	public $table = 'tuvan';
	public $searchFields = array('id');
    public $Searchlabels = 'Id';
	public $filterFields = array(
		array(
            'index' => 'type',
            'type' => 'selectoption',
            'label' => 'Loại tư vấn',
            'option' => array(
				'tamly' => "Tâm lí",
                'hoctap' => "Học tập"
			)
        ),
		array(
            'index'=>'status',
            'type' => 'status',
            'label' => 'Trạng thái'
        )
	);
	public $listFieldSettings = array(
		array(
            'label' 	=> "Tên đăng nhập",
			'index' 	=> "userId",
			'type' 		=> "nameid",
			'table' 	=> 'user',
			'findField' => 'id',
			'showField' => 'name',
        ),
        array(
            'index' => 'content',
            'type' => 'text',
            'label' => 'Nội dung'
        ),
		array(
            'index' => 'type',
            'type' => 'text',
            'label' => 'Kiểu tư vấn'
        ),
		
		array(
            'index' => 'tuvan',
            'type' => 'text',
            'label' => 'Tư vấn'
        ),
		array(
			'index' 	=> 'created',
			'type' 		=> 'datetime',
			'label' 	=> 'Yêu cầu tư vấn'
		),
		array(
			'index' 	=> 'modified',
			'type' 		=> 'datetime',
			'label' 	=> 'Ngày tư vấn'
		),
        array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'Trạng thái'
        )
    );
	
	public $editLabel = "Tư vấn";
	public $editFields = 'tuvan, status';
	public $editFieldSettings = array(
		array(
			'index' => 'tuvan',
			'type' => 'tinymce',
			'label' => "Tư vấn"
		),
		
		array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'Trạng thái',
			'mdsize'	=> 3
        ),
		
		
	);
    
    public $editValidator = array(
        'rules' => array(
            'tuvan' => array(
                'required' => true,
                'minlength' => 1
            ),
            

        ),
        'messages' => array(
            'tuvan' => array(
                'required' => 'Tư vấn không được để trống',
                'minlength' => 'Tư vấn phải dài 1 ký tự trở lên'
                
            ),
            
        )
    );
}
?>