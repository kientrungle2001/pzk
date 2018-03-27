<?php 
class PzkAdminAreacodeController extends PzkGridAdminController {
    public $addFields = 'name, parent, parents, type, status, software';
    public $editFields = 'name, parent, parents, type, status, software';
    public $table = 'areacode';
	public $joins = array(
		array(
			'table'		=> 'areacode as p',
			'condition'	=> 'areacode.parent = p.id',
			'type'		=>	'left'
		)
	);
	public $selectFields = 'areacode.*, p.name as parentName';
	public $filterStatus = true;
   
    public $sortFields = array(
        'id asc' => 'ID tăng',
        'id desc' => 'ID giảm',
        'name asc' => 'name tăng',
        'name desc' => 'name giảm',
    );
    public $searchFields = array('`areacode`.`name`', '`areacode`.`id`');
    public $Searchlabels = 'Tên';
	
	public $listSettingType = 'parent';
    public $listFieldSettings = array(
        array(
            'index' => 'name',
            'type' => 'parent',
            'label' => 'Địa điểm'
        ),
		array(
            'index' => 'parentName',
            'type' => 'text',
            'label' => 'Địa phận'
        ),
		array(
            'index' => 'type',
            'type' => 'text',
            'label' => 'Type',
        ),
		array(
			'index' => "add_child",
			'type' => 'link',
			'label' => 'Thêm con',
			'link' => '/Admin_Areacode/add?status=1&hidden_status=1&parent='
		),
        array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'Trạng thái'
        ),
        array(
            'index' => 'mark',
            'type' => 'status',
            'label' => 'Đánh dấu'
        ),
    );
	
	public $addLabel = 'Thêm địa điểm';
    public $addFieldSettings = array(
        array(
            'index' => 'name',
            'type' => 'text',
            'label' => 'Địa điểm',
        ),
		array(
            'index' => 'parent',
            'type' => 'text',
            'label' => 'Cha'
        ),
		
		array(
			'index' => 'type',
			'type' => 'text',
			'label' => 'Loại địa danh',
			'mdsize'	=> 3
		),
       
        array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'Trạng thái'
        )
    );
    public $editFieldSettings = array(
        array(
            'index' => 'name',
            'type' => 'text',
            'label' => 'Địa điểm',
        ),
		array(
            'index' => 'parent',
            'type' => 'text',
            'label' => 'Cha'
        ),
		
		array(
			'index' => 'type',
			'type' => 'text',
			'label' => 'Loại địa điểm',
			'mdsize'	=> 3
		),
       
        array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'Trạng thái'
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