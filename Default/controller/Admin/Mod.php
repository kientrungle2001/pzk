<?php
class PzkAdminModController extends PzkGridAdminController
{
    public $title = 'Quản lí người dùng';
    public $table = 'admin';
    //joins to many table
    public $joins = array(
        array(
            ATTR_TABLE => 'admin_level',
            ATTR_CONDITION => 'admin.usertype_id = admin_level.id',
            ATTR_TYPE => JOIN_TYPE_LEFT
        )
    );
    //select table
    public $selectFields = 'admin.*, admin_level.level';
    //show fields on page index
    public $listFieldSettings = array(
        array(
            ATTR_INDEX => 'name',
            ATTR_TYPE => 'text',
            ATTR_LABEL => 'Tên User'
        ),
        array(
            ATTR_INDEX     => 'parent',
            ATTR_TYPE         => 'nameid',
            ATTR_LABEL     => 'Cha',
            ATTR_TABLE        =>    'admin',
            ATTR_FIND_FIELD    =>    'id',
            ATTR_SHOW_FIELD    =>    'name'
        ),
        array(
            ATTR_INDEX => 'categoryIds',
            ATTR_TYPE => 'text',
            ATTR_LABEL => 'Danh mục'
        ),
        array(
            ATTR_INDEX => 'level',
            ATTR_TYPE => 'text',
            ATTR_LABEL => 'Tên quyền',
            ATTR_LINK    => '/Admin_Mod/filter?type=select&index=usertype_id&id='
        ),

        array(
            ATTR_INDEX => 'status',
            ATTR_TYPE => 'status',
            ATTR_LABEL => 'Trạng thái'
        )

    );
    public $logable = true;
    public $logFields = 'name, usertype_id, status';
    //search fields co type la text
    public $searchFields = array('name');
    public $Searchlabels = 'Tên';
    //filter cho cac truong co type la select
    public $filterFields = array(

        array(
            ATTR_INDEX => 'usertype_id',
            ATTR_TYPE => 'select',
            ATTR_LABEL => 'Tên quyền',
            ATTR_TABLE => 'admin_level',
            ATTR_SHOW_VALUE => 'id',
            ATTR_SHOW_NAME => 'level',
        ),
        array(
            ATTR_INDEX => 'status',
            ATTR_TYPE => 'status',
            ATTR_LABEL => 'Trạng thái'
        )

    );
    //sort by
    public $sortFields = array(
        'id asc' => 'ID tăng',
        'id desc' => 'ID giảm',

    );

    //add table
    public $addFields = 'name, usertype_id, password, areacode, district, school, class, classname, categoryIds, status, parent';
    public $addLabel = 'Thêm người dùng';

    //add theo dang binh thuong
    public $addFieldSettings = array(
        array(
            ATTR_INDEX => 'name',
            ATTR_TYPE => EDIT_TYPE_TEXT,
            ATTR_LABEL => 'Tên người dùng'
        ),

        array(
            ATTR_INDEX => 'password',
            ATTR_TYPE => 'password',
            ATTR_LABEL => 'Mật khẩu'
        ),
        array(
            ATTR_INDEX         => 'parent',
            ATTR_TYPE             => EDIT_TYPE_SELECT,
            ATTR_LABEL           => 'Cha',
            ATTR_TABLE           => 'admin',
            ATTR_SHOW_VALUE      => 'id',
            ATTR_SHOW_NAME      => 'name'
        ),
        array(
            ATTR_INDEX         => 'categoryIds',
            ATTR_TYPE             => EDIT_TYPE_MULTISELECT,
            ATTR_LABEL           => 'Danh mục cha',
            ATTR_TABLE           => 'categories',
            ATTR_SHOW_VALUE      => 'id',
            ATTR_SHOW_NAME      => 'name'
        ),
        array(
            ATTR_INDEX => 'areacode',
            ATTR_TYPE => EDIT_TYPE_TEXT,
            ATTR_LABEL => 'Tỉnh/Thành phố'
        ),
        array(
            ATTR_INDEX => 'district',
            ATTR_TYPE => EDIT_TYPE_TEXT,
            ATTR_LABEL => 'Quận/Huyện'
        ),
        array(
            ATTR_INDEX => 'school',
            ATTR_TYPE => EDIT_TYPE_TEXT,
            ATTR_LABEL => 'Trường'
        ),
        array(
            ATTR_INDEX => 'class',
            ATTR_TYPE => EDIT_TYPE_TEXT,
            ATTR_LABEL => 'Khối'
        ),
        array(
            ATTR_INDEX => 'classname',
            ATTR_TYPE => EDIT_TYPE_TEXT,
            ATTR_LABEL => 'Tên lớp'
        ),
        array(
            ATTR_INDEX => 'usertype_id',
            ATTR_TYPE => EDIT_TYPE_SELECT,
            ATTR_LABEL => 'Tên quyền',
            ATTR_TABLE => 'admin_level',
            ATTR_SHOW_VALUE => 'id',
            ATTR_SHOW_NAME => 'level',
        ),

        array(
            ATTR_INDEX => 'status',
            ATTR_TYPE => EDIT_TYPE_STATUS,
            ATTR_LABEL => 'Trạng thái',
        )
    );
    public $addValidator = array(
        'rules' => array(
            'name' => array(
                'required' => true,
                'minlength' => 2,
                'maxlength' => 50
            ),
            'password' =>
            array(
                'minlength' => 4,
            )

        ),
        'messages' => array(
            'name' => array(
                'required' => 'Tên nhóm không được để trống',
                'minlength' => 'Tên nhóm phải dài 2 ký tự trở lên',
                'maxlength' => 'Tên nhóm chỉ dài tối đa 50 ký tự'
            ),
            'password' =>
            array(
                'minlength' => 'Mật khẩu dài tối thiểu 4 ký tự',
            )

        )
    );

    //edit table
    public $editLabel = 'Sửa người dùng';
    public $editFields = 'name, usertype_id, password, areacode, district, school, class, classname, categoryIds, status,parent';

    //edit theo dang binh thuong
    public $editFieldSettings = array(
        array(
            ATTR_INDEX => 'name',
            ATTR_TYPE => 'text',
            ATTR_LABEL => 'Tên người dùng'
        ),

        array(
            ATTR_INDEX => 'password',
            ATTR_TYPE => 'password',
            ATTR_LABEL => 'Mật khẩu mới'
        ),
        array(
            ATTR_INDEX         => 'parent',
            ATTR_TYPE             => EDIT_TYPE_SELECT,
            ATTR_LABEL           => 'Cha',
            ATTR_TABLE           => 'admin',
            ATTR_SHOW_VALUE      => 'id',
            ATTR_SHOW_NAME      => 'name'
        ),
        array(
            ATTR_INDEX         => 'categoryIds',
            ATTR_TYPE             => EDIT_TYPE_MULTISELECT,
            ATTR_LABEL           => 'Danh mục cha',
            ATTR_TABLE           => 'categories',
            ATTR_SHOW_VALUE      => 'id',
            ATTR_SHOW_NAME      => 'name'
        ),
        array(
            ATTR_INDEX => 'areacode',
            ATTR_TYPE => 'text',
            ATTR_LABEL => 'Tỉnh/Thành phố'
        ),
        array(
            ATTR_INDEX => 'district',
            ATTR_TYPE => 'text',
            ATTR_LABEL => 'Quận/Huyện'
        ),
        array(
            ATTR_INDEX => 'school',
            ATTR_TYPE => 'text',
            ATTR_LABEL => 'Trường'
        ),
        array(
            ATTR_INDEX => 'class',
            ATTR_TYPE => 'text',
            ATTR_LABEL => 'Khối'
        ),
        array(
            ATTR_INDEX => 'classname',
            ATTR_TYPE => 'text',
            ATTR_LABEL => 'Tên lớp'
        ),
        array(
            ATTR_INDEX => 'usertype_id',
            ATTR_TYPE => 'select',
            ATTR_LABEL => 'Tên quyền',
            ATTR_TABLE => 'admin_level',
            ATTR_SHOW_VALUE => 'id',
            ATTR_SHOW_NAME => 'level'
        ),

        array(
            ATTR_INDEX => 'status',
            ATTR_TYPE => 'status',
            ATTR_LABEL => 'Trạng thái',
        )
    );

    public $editValidator = array(
        'rules' => array(
            'name' => array(
                'required' => true,
                'minlength' => 2,
                'maxlength' => 50
            )


        ),
        'messages' => array(
            'name' => array(
                'required' => 'Tên nhóm không được để trống',
                'minlength' => 'Tên nhóm phải dài 2 ký tự trở lên',
                'maxlength' => 'Tên nhóm chỉ dài tối đa 50 ký tự'
            )



        )
    );
    //add link menu

    //export data
    public $exportFields = array('admin.id', 'admin.name', 'admin_level.level');
    public $exportTypes = array('pdf', 'excel', 'csv');
    //import
    public $importFields = array('level', 'username');
    public function editPostAction()
    {
        $row = $this->getEditData();
        if ($this->validateEditData($row)) {
            $password = trim(pzk_request('password'));
            if ($password) {

                $row['password'] = md5($password);
                $this->edit($row);
                pzk_notifier()->addMessage('Cập nhật thành công');
                $this->redirect('index');
            } else {
                unset($row['password']);
                $this->edit($row);
                pzk_notifier()->addMessage('Cập nhật thành công');
                $this->redirect('index');
            }
        } else {
            pzk_validator()->setEditingData($row);
            $this->redirect('edit/' . pzk_request('id'));
        }
    }
    public function addPostAction()
    {
        $row = $this->getAddData();
        if ($this->validateAddData($row)) {
            $modeladmin = pzk_model('Admin');
            $checkUser = $modeladmin->checkUser($row['name']);
            if ($checkUser) {
                pzk_notifier_add_message('Tên đăng nhập đã được sử dụng', 'danger');
                pzk_validator()->setEditingData($row);
                $this->redirect('add');
            } else {
                $password = trim(pzk_request('password'));
                if ($password) {
                    $row['password'] = md5($password);

                    $this->add($row);

                    pzk_notifier()->addMessage('Cập nhật thành công');
                    $this->redirect('index');
                } else {
                    pzk_validator()->setEditingData($row);
                    $this->redirect('add');
                }
            }
        } else {
            pzk_validator()->setEditingData($row);
            $this->redirect('add');
        }
    }
}
