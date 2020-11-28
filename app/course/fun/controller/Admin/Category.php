<?php
class PzkAdminCategoryController extends PzkGridAdminController
{
  public $table = 'categories';
  public $addFields = 'name, parent, router, img, status, software, content, alias';
  public $mdAddOffset	= '2';
	public $mdAddSize	= '8';

  public function getFilterFields()
  {
    return PzkEditConstant::gets('parentOfCategory, status', 'categories');
  }
  public function getListFieldSettings()
  {
    return PzkListConstant::gets('ordering, name, alias, router, status', 'categories');
  }

  public $searchFields = array('name');
  public $searchLabel = 'Tên';

  //sort by
  public function getSortFields()
  {
    return PzkSortConstant::gets('id, ordering, name', 'categories');
  }

  public $logable = true;
  public $logFields = 'name, alias, router';
  public $addLabel = 'Thêm Danh mục';

  public function getAddFieldSettings()
  {
    return PzkEditConstant::gets('nameOfCategory, alias, router, parent, img, 
				content, status', 'categories');
  }

  public function getAddValidator()
  {
    return PzkValidatorConstant::gets(
      array(
        'name' => array(
          'required' => true, 'minlength' => 2, 'maxlength' => 500
        )
      )
    );
  }

  public $listSettingType = 'parent';
  public $fixedPageSize = 200;

  public function editPostAction()
  {
    $row = $this->getEditData();
    $id = pzk_request()->getId();

    if ($this->validateEditData($row)) {
      $data = _db()->useCB()->select('img')->from('categories')->where(array('id', $id))->result_one();
      if (($row['img'] != $data['img']) and !empty($data['img'])) {
        $url = BASE_DIR . $data['img'];
        unlink($url);
      }
      $this->edit($row);
      pzk_notifier()->addMessage('Cập nhật thành công #' . $id);
      $this->redirect('index');
    } else {
      pzk_validator()->setEditingData($row);
      $this->redirect('edit/' . pzk_request()->getId());
    }
  }

  public function delPostAction()
  {
    $id = pzk_request()->getId();
    $data = _db()->useCB()->select('img')->from($this->table)->where(array('id', $id))->result_one();
    if ($data['img']) {
      unlink($data['img']);
    }
    _db()->useCB()->delete()->from($this->table)
      ->where(array('id', $id))->result();

    pzk_notifier()->addMessage('Xóa thành công');
    $this->redirect('index');
  }

  public function delAllAction()
  {
    if (pzk_request()->getIds()) {
      $arrIds = json_decode(pzk_request()->getIds());
      if (count($arrIds) > 0) {
        _db()->useCB()->delete()->from($this->table)
          ->where(array('in', 'id', $arrIds))->result();

        foreach ($arrIds as $item) {
          $data = _db()->useCB()->select('img')->from($this->table)->where(array('id', $item))->result_one();
          if ($data['img']) {
            $tam = explode("/", $data['img']);
            $url2 = end($tam);
            $url = BASE_DIR . $data['img'];
            unlink($url);
            unlink(BASE_DIR . '/tmp/' . $url2);
          }
        }

        echo 1;
      }
    } else {
      die();
    }
  }
}
