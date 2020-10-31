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
            ATTR_TYPE => LIST_TYPE_TEXT,
            ATTR_LABEL => 'Tên đăng nhập'
        ),
        array(
            ATTR_INDEX     => 'parent',
            ATTR_TYPE         => LIST_TYPE_NAMEID,
            ATTR_LABEL     => 'Cấp trên',
            ATTR_TABLE        =>    'admin',
            ATTR_FIND_FIELD    =>    'id',
            ATTR_SHOW_FIELD    =>    'name'
        ),
        array(
            ATTR_INDEX => 'level',
            ATTR_TYPE => LIST_TYPE_TEXT,
            ATTR_LABEL => 'Quyền',
            ATTR_LINK    => '/Admin_Mod/filter?type=select&index=usertype_id&id='
        ),

        array(
            ATTR_INDEX => 'status',
            ATTR_TYPE => LIST_TYPE_STATUS,
            ATTR_LABEL => 'Trạng thái'
        )

    );
    public $logable = true;
    public $logFields = 'name, usertype_id, status';
    //search fields co type la text
    public $searchFields = array('name');
    public $searchLabel = 'Tên';

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
            ATTR_INDEX => 'parent',
            ATTR_TYPE => 'select',
            ATTR_LABEL => 'Cấp trên',
            ATTR_TABLE => 'admin',
            ATTR_SHOW_VALUE => 'id',
            ATTR_SHOW_NAME => 'name',
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
    public $mdAddOffset = '2';
	public $mdAddSize = '8';

    //add theo dang binh thuong
    public $addFieldSettings = array(
        array(
            ATTR_INDEX => 'name',
            ATTR_TYPE => EDIT_TYPE_TEXT,
            ATTR_LABEL => 'Tên người dùng',
            ATTR_MD_SIZE => 4
        ),

        array(
            ATTR_INDEX => 'password',
            ATTR_TYPE => EDIT_TYPE_PASSWORD,
            ATTR_LABEL => 'Mật khẩu',
            ATTR_MD_SIZE => 4
        ),
        array(
            ATTR_INDEX         => 'parent',
            ATTR_TYPE             => EDIT_TYPE_SELECT,
            ATTR_LABEL           => 'Cấp trên',
            ATTR_TABLE           => 'admin',
            ATTR_SHOW_VALUE      => 'id',
            ATTR_SHOW_NAME      => 'name',
            ATTR_MD_SIZE => 4
        ),
        array(
            ATTR_INDEX => 'usertype_id',
            ATTR_TYPE => EDIT_TYPE_SELECT,
            ATTR_LABEL => 'Tên quyền',
            ATTR_TABLE => 'admin_level',
            ATTR_SHOW_VALUE => 'id',
            ATTR_SHOW_NAME => 'level',
            ATTR_MD_SIZE => 4
        ),

        array(
            ATTR_INDEX => 'status',
            ATTR_TYPE => EDIT_TYPE_STATUS,
            ATTR_LABEL => 'Trạng thái',
            ATTR_MD_SIZE => 4
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
            $password = trim(pzk_request()->getPassword());
            if ($password) {
                $row['password'] = md5($password);
                $this->edit($row);
                pzk_notifier()->addMessage('Cập nhật thành công bản ghi #' . $row['id']);
                $this->redirect('index');
            } else {
                unset($row['password']);
                $this->edit($row);
                pzk_notifier()->addMessage('Cập nhật thành công bản ghi #' . $row['id']);
                $this->redirect('index');
            }
        } else {
            pzk_validator()->setEditingData($row);
            $this->redirect('edit' . DS . pzk_request()->getId());
        }
    }
    public function addPostAction()
    {
        $row = $this->getAddData();
        if ($this->validateAddData($row)) {
            /**
             * @var PzkAdminModel $modeladmin
             */
            $modeladmin = pzk_model('Admin');
            $checkUser = $modeladmin->checkUser($row['name']);
            if ($checkUser) {
                pzk_notifier_add_message('Tên đăng nhập đã được sử dụng', 'danger');
                pzk_validator()->setEditingData($row);
                $this->redirect('add');
            } else {
                $password = trim(pzk_request()->getPassword());
                if ($password) {
                    $row['password'] = md5($password);

                    $rowId = $this->add($row);
                    $row['id'] = $rowId;

                    pzk_notifier()->addMessage('Cập nhật thành công #' . $row['id']);
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
