<?php
class PzkAdminVideoController extends PzkGridAdminController {
    public $addFields = 'url, status, name, category_id';
    public $editFields = 'url, status, name, category_id';
    public $table = 'video';
    public $sortFields = array(
        'id asc' => 'ID tăng',
        'id desc' => 'ID giảm',
        'name asc' => 'Name tăng',
        'name desc' => 'Name giảm',
    );
    public $searchFields = array('name');
    public $listFieldSettings = array(
        array(
            'index' => 'name',
            'type' => 'link',
            'label' => 'Tên video'
        ),

        array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'Trạng thái'
        )
    );
    public $addLabel = 'Thêm video';
    public $addFieldSettings = array(
        array(
            'index' => 'name',
            'type' => 'text',
            'label' => 'Tên Video',
        ),
        array(
            'index' => 'url',
            'type' => 'upload',
            'uploadtype'=>'video',
            'label' => 'Chọn Video',
        ),

        array(
            'index' => 'category_id',
            'type' => 'select',
            'label' => 'Menu cha',
            'table' => 'categories',
            'show_name' => 'name',
            'show_value' =>'id'

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
            'index' => 'name',
            'type' => 'text',
            'label' => 'Tên Video',
        ),
        array(
            'index' => 'url',
            'type' => 'upload',
            'uploadtype'=>'video',
            'label' => 'Chọn Video',
        ),


        array(
            'index' => 'category_id',
            'type' => 'select',
            'label' => 'Menu cha',
            'table' => 'categories',
            'show_name' => 'name',
            'show_value' =>'id'
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
            'name' => array(
                'required' => true,
                'minlength' => 2,
                'maxlength' => 50
            )

        ),
        'messages' => array(
            'name' => array(
                'required' => 'Tên menu không được để trống',
                'minlength' => 'Tên menu phải dài 2 ký tự trở lên',
                'maxlength' => 'Tên menu chỉ dài tối đa 50 ký tự'
            )

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
                'required' => 'Tên menu không được để trống',
                'minlength' => 'Tên menu phải dài 2 ký tự trở lên',
                'maxlength' => 'Tên menu chỉ dài tối đa 50 ký tự'
            )

        )
    );



    public function editPostAction() {
        $row = $this->getEditData();
        $id = pzk_request()->get('id');

        if($this->validateEditData($row)) {
            $data = _db()->useCB()->select('url')->from('video')->where(array('id', $id))->result_one();
            if(($row['url'] != $data['url']) and !empty($data['url'])) {
                $url = BASE_DIR.$data['url'];
                unlink($url);
            }
            $this->edit($row);
            pzk_notifier()->addMessage('Cập nhật thành công');
            $this->redirect('index');
        } else {
            pzk_validator()->setEdittingData($row);
            $this->redirect('edit/' . pzk_request('id'));
        }
    }

    public function delPostAction() {
        $id = pzk_request()->get('id');
        $data = _db()->useCB()->select('url')->from('video')->where(array('id', $id))->result_one();
        if($data['url']) {
            $tam = explode("/",$data['url']);
            $url2 = end($tam);
            $url = BASE_DIR.$data['url'];
            unlink($url);
            unlink(BASE_DIR.'/tmp/'.$url2);
        }

        _db()->useCB()->delete()->from($this->table)
            ->where(array('id', $id))->result();

        pzk_notifier()->addMessage('Xóa thành công');
        $this->redirect('index');
    }
    public function delAllAction() {
        if(pzk_request('ids')) {
            $arrIds = json_decode(pzk_request('ids'));
            if(count($arrIds) >0) {
                _db()->useCB()->delete()->from($this->table)
                    ->where(array('in', 'id', $arrIds))->result();

                foreach($arrIds as $item) {
                    $data = _db()->useCB()->select('url')->from('video')->where(array('id', $item))->result_one();
                    if($data['url']) {
                    $tam = explode("/",$data['url']);
                    $url2 = end($tam);
                    $url = BASE_DIR.$data['url'];
                    unlink($url);
                    unlink(BASE_DIR.'/tmp/'.$url2);
                    }
                }

                echo 1;
            }

        }else {
            die();
        }


    }
}
?>