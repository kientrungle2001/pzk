<?php
class PzkAdminCardNexnobelsController extends PzkGridAdminController {
    public $addFields = 'pincard, serial, price,discount,useradd,dateadd';
    public $editFields = 'pincard, serial, price,discount,usermodified,datemodified';
    public $table='card_nextnobels';
    public $sortFields = array(
        'id asc' => 'ID tăng',
        'id desc' => 'ID giảm'
       
    );
    public $searchFields = array('pincard, pincard_normal,serial');
    public $listFieldSettings = array(
        array(
            'index' => 'pincard_normal',
            'type' => 'text',
            'label' => 'Mã thẻ'
        ),
        array(
            'index' => 'serial',
            'type' => 'text',
            'label' => 'Serial '
        ),
        array(
            'index' => 'price',
            'type' => 'text',
            'label' => 'Giá '
        ),
        array(
            'index' => 'discount',
            'type' => 'text',
            'label' => 'Giảm giá '
        )

    );
	public $logable = true;
	public $logFields = 'pincard, serial, price, discount';
    public $addLabel = 'Thêm bạn mới';
    public $addFieldSettings = array(
        array(
            'index' => 'pincard',
            'type' => 'text',
            'label' => 'Mã thẻ'
        ),
        array(
            'index' => 'serial',
            'type' => 'text',
            'label' => 'Serial '
        ),
        array(
            'index' => 'price',
            'type' => 'text',
            'label' => 'Giá '
        ),
        array(
            'index' => 'discount',
            'type' => 'text',
            'label' => 'Giảm giá '
        )
    );
    public $editFieldSettings = array(
         array(
            'index' => 'pincard',
            'type' => 'text',
            'label' => 'Mã thẻ'
        ),
        array(
            'index' => 'serial',
            'type' => 'text',
            'label' => 'Serial '
        ),
        array(
            'index' => 'price',
            'type' => 'text',
            'label' => 'Giá '
        )
    );
    public $addValidator = array(
        'rules' => array(
            'pincard' => array(
                'required' => true
            ),
            'serial' => array(
                'required' => true
               
            )

        ),
        'messages' => array(
            'pincard' => array(
                'required' => 'Pincard không được để trống'
                
            ),
            'serial' => array(
                'required' => 'Serial không được để trống'
                
            )
        )
    );
    public $editValidator = array(
        'rules' => array(
            'serial' => array(
                'required' => true
               
            )

        ),
        'messages' => array(
            
            'serial' => array(
                'required' => 'Serial không được để trống'
                
            )
        )
    );
    public function editPostAction() {
        $row = $this->getEditData();
        $pincard=pzk_request()->getPincard();
        if($this->validateEditData($row)) {
            $row['pincard'] = md5($pincard);
            $row['userModified']=pzk_session('adminId');
            $row['dateModified']=date("Y-m-d H:i:s");
            $this->edit($row);
            pzk_notifier()->addMessage('Cập nhật thành công');
            $this->redirect('index');          
        
        } else {
            pzk_validator()->setEdittingData($row);
            $this->redirect('edit/' . pzk_request()->getId());
        }
    }
    public function addPostAction() {
        $row = $this->getAddData();
        if($this->validateAddData($row)) {
            $pincard = trim(pzk_request()->getPincard());
            if($pincard) {
                $row['pincard'] = md5($pincard);
                $row['userAdd']=pzk_session('adminId');
                $row['dateAdd']=date("Y-m-d H:i:s");
                $row['status']=1;
                $this->add($row);

                pzk_notifier()->addMessage('Cập nhật thành công');
                $this->redirect('index');
            } else {
                pzk_validator()->setEdittingData($row);
                $this->redirect('add');
            }
        } else {
            pzk_validator()->setEdittingData($row);
            $this->redirect('add');
        }
    }

}