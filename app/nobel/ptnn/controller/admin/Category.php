<?php
class PzkAdminCategoryController extends PzkGridAdminController {
	public $table = 'categories';
	public $title = 'Quản lý Danh mục';
	public $listSettingType = true;
	
    public function getJoins() { 
		return PzkJoinConstant::gets('creator, modifier', 'categories');
	}
	public $selectFields = 'categories.*, creator.name as creatorName, modifier.name as modifiedName';
	public function getListFieldSettings() { 
		return array(
			PzkListConstant::get('nameOfCate', 'category'),
			PzkListConstant::group('<br/>Bí danh<br/>Đường dẫn', 'alias, router', 'category'),
			PzkListConstant::get('question_types', 'category'),
			PzkListConstant::get('ordering', 'category'),
			PzkListConstant::group('<br/>Trạng thái<br/>Sắp xếp<br/>Hiển thị', 'status, isSort, display', 'category'),
			PzkListConstant::group('<br />Người tạo<br />Người sửa', 'creatorName, modifiedName', 'category'),
			PzkListConstant::group('<br />Ngày tạo<br />Ngày sửa', 'created, modified', 'category'),
			PzkListConstant::get('software', 'category'),
			PzkListConstant::get('sharedSoftwares', 'category'),
			PzkListConstant::get('global', 'category'),
		);
	}

    public $searchFields = array('`categories`.`name`', '`categories`.`router`');
    public $searchLabel = 'Tên';
    
	
	 public function getFilterFields() { 
		return PzkFilterConstant::gets('status', 'category');
    }
    
    //sort by
    public function getSortFields() { 
		return PzkSortConstant::gets('id, name, ordering', 'categories');
    }
    
    public $quickMode = false;
	public function getQuickFieldSettings(){
		return PzkListConstant::gets('name', 'category');
	}
    
	public $logable = true;
	public $logFields = 'name, alias, router';
	
	
	public $addFields = 'name, parent, router, img, status, display,  content, recommend, isSort, alias, question_types, software, sharedSoftwares, global';
	public $editFields = 'name, parent, router, img, status, display,  content, recommend, isSort, alias, question_types, software, sharedSoftwares, global';
	
	public $addLabel = 'Thêm Danh mục';
	public function getAddFieldSettings() { 
		return array (
			PzkEditConstant::get('name', 'category'),
			PzkEditConstant::get('alias', 'category'),
			PzkEditConstant::get('router', 'category'),
			PzkEditConstant::get('parent', 'category'),
            PzkEditConstant::get('question_types', 'category'),
            PzkEditConstant::get('img', 'category'),
			PzkEditConstant::get('status', 'category'),
			PzkEditConstant::get('isSort', 'category'),
            PzkEditConstant::get('display', 'category'),
			PzkEditConstant::get('meta_keywords', 'category'),
			PzkEditConstant::get('meta_description', 'category'),
			PzkEditConstant::get('sharedSoftwares', 'category'),
			PzkEditConstant::get('global', 'category'),
		);
	}
	public $editLabel = 'Sửa danh mục';
	public function getEditFieldSettings() {
		return array (
			PzkEditConstant::get('name', 'category'),
			PzkEditConstant::get('alias', 'category'),
			PzkEditConstant::get('router', 'category'),
			PzkEditConstant::get('parent', 'category'),
            PzkEditConstant::get('question_types', 'category'),
            PzkEditConstant::get('img', 'category'),
			PzkEditConstant::get('status', 'category'),
			PzkEditConstant::get('isSort', 'category'),
            PzkEditConstant::get('display', 'category'),
			PzkEditConstant::get('meta_keywords', 'category'),
			PzkEditConstant::get('meta_description', 'category'),
			PzkEditConstant::get('sharedSoftwares', 'category'),
			PzkEditConstant::get('global', 'category'),
		);
	}
	
	public $addValidator = array(
		'rules' => array(
			'name' => array(
				'required' => true,
				'minlength' => 2,
				'maxlength' => 255
			)
		),
		'messages' => array(
			'name' => array(
				'required' => 'Tên danh mục không được để trống',
				'minlength' => 'Tên danh mục phải dài 2 ký tự trở lên',
				'maxlength' => 'Tên danh mục chỉ dài tối đa 255 ký tự'
			)
		)
	);
	public $editValidator = array(
		'rules' => array(
			'name' => array(
				'required' => true,
				'minlength' => 2,
				'maxlength' => 255
			)
		),
		'messages' => array(
			'name' => array(
				'required' => 'Tên danh mục không được để trống',
				'minlength' => 'Tên danh mục phải dài 2 ký tự trở lên',
				'maxlength' => 'Tên danh mục chỉ dài tối đa 255 ký tự'
			)
		)
	);
	
	
	public $detailFields = 'categories.*, creator.name as creatorName, modifier.name as modifiedName';
    public function getViewFieldSettings() { 
		return PzkListConstant::gets('name, alias, router, img, meta_keywords, meta_description, 
			creatorName, modifiedName, created, modified, 
			statusText, isSortText, displayText, orderingText', 'category');
	}
    
    public function getParentDetailSettings() { 
		return array(
			PzkParentConstant::get('creator', 'category'),
			PzkParentConstant::get('modifier', 'category'),
			PzkParentConstant::get('parent', 'category', PzkListConstant::gets('nameOfCategory, alias, router, statusText, displayText', 'category'))
		);
	}
	
	public function getChildrenGridSettings() { 
		return array(
			array(
				'index'	=> 'news',
				'title'	=> 'News',
				'label'	=> 'News',
				'table'	=> 'news',
				'joins'	=> PzkJoinConstant::gets('category, campaign, creator, modifier', 'news'),
				'fields'	=> 'news.*, categories.name as categoryName, campaign.campaignName as campaignName, creator.name as creatorName, modifier.name as modifiedName',
				'parentField'	=> 'categoryId',
				'orderBy'	=> 'news.id desc',
				'addLabel'	=> 'Add News',
				'quickMode'	=> false,
				'module'	=> 'category_news',
				'listFieldSettings'	=>  array(
					PzkListConstant::get('img', 'news'),
					PzkListConstant::group('<br />Tiêu đề<br />Bí danh', 'title, alias', 'news'),
					PzkListConstant::group('<br />Từ khóa<br />Mô tả', 'meta_keywords, meta_description', 'news'),
					PzkListConstant::get('categoryName', 'news'),
					PzkListConstant::get('campaignName', 'news'),
					PzkListConstant::group('<br />Xem<br />Thích<br />Bình luận', 'views, likes, comments', 'news'),
					PzkListConstant::group('<br />Người tạo<br />Người sửa', 'creatorName, modifiedName', 'news'),
					PzkListConstant::group('<br />Ngày tạo<br />Ngày sửa', 'created, modified', 'news'),
					PzkListConstant::group('<br />Ngày bắt đầu<br />Ngày kết thúc', 'startDate, endDate', 'news'),
					PzkListConstant::get('ordering', 'news'),
					PzkListConstant::get('status', 'news'),
				),
				'sortFields' => PzkSortConstant::gets('id, title, categoryId, ordering', 'news')
			),
			array(
				'index'	=> 'featured',
				'title'	=> 'Featured',
				'label'	=> 'Featured',
				'table'	=> 'featured',
				'joins'	=> PzkJoinConstant::gets('category, campaign, creator, modifier', 'featured'),
				'fields'	=> 'featured.*, categories.name as categoryName, campaign.campaignName as campaignName, creator.name as creatorName, modifier.name as modifiedName',
				'parentField'	=> 'categoryId',
				'orderBy'	=> 'featured.id desc',
				'addLabel'	=> 'Add Featured',
				'quickMode'	=> false,
				'module'	=> 'category_featured',
				'listFieldSettings'	=>  array(
					PzkListConstant::get('img', 'featured'),
					PzkListConstant::group('<br />Tiêu đề<br />Bí danh', 'title, alias', 'featured'),
					PzkListConstant::group('<br />Từ khóa<br />Mô tả', 'meta_keywords, meta_description', 'featured'),
					PzkListConstant::get('categoryName', 'featured'),
					PzkListConstant::get('campaignName', 'featured'),
					PzkListConstant::group('<br />Xem<br />Thích<br />Bình luận', 'views, likes, comments', 'featured'),
					PzkListConstant::group('<br />Người tạo<br />Người sửa', 'creatorName, modifiedName', 'featured'),
					PzkListConstant::group('<br />Ngày tạo<br />Ngày sửa', 'created, modified', 'featured'),
					PzkListConstant::group('<br />Ngày bắt đầu<br />Ngày kết thúc', 'startDate, endDate', 'featured'),
					PzkListConstant::get('ordering', 'featured'),
					PzkListConstant::get('status', 'featured'),
				),
				'sortFields' => PzkSortConstant::gets('id, title, categoryId, ordering', 'featured')
			),
			array(
				'index'	=> 'questions',
				'title'	=> 'Questions',
				'label'	=> 'Questions',
				'table'	=> 'questions',
				'fields'	=> '*',
				'parentField'	=> 'categoryIds',
				'parentWhere'	=> 'like',
				'orderBy'	=> 'questions.id desc',
				'addLabel'	=> 'Add Featured',
				'quickMode'	=> false,
				'module'	=> 'category_featured',
				'listFieldSettings'	=>  array(
					array(
						'index' => 'name',
						'type' => 'text',
						'label' => 'Câu hỏi',
						'link'	=> '/Admin_Question2/detail/'
					),
					array(
						'label' => "Đề thi",
						'index' => "testId",
						'type' => "nameid",
						'table' => 'tests',
						'findField' => 'id',
						'showField' => 'name'
					),
					
					array(
						'index' => 'created',
						'type' => 'datetime',
						'label' => 'Ngày tạo'
					),
					array(
							'index' => 'classes',
							'type' => 'ordering',
							'label' => 'C'
					),
					array(
							'index' => 'ordering',
							'type' => 'ordering',
							'label' => 'O'
					),
					array(
							'index' => 'level',
							'type' => 'ordering',
							'label' => 'L'
					),
					array(
						'index' => 'trial',
						'type' => 'status',
						'label' => 'T'
					),
					array(
						'index' => 'status',
						'type' => 'status',
						'label' => 'S'
					),
					array(
						'index' => 'check',
						'type' => 'status',
						'label' => 'C'
					),
					array(
						'index' => 'deleted',
						'type' => 'status',
						'label' => 'D'
					),
						
				),
				'sortFields' => PzkSortConstant::gets('id, name, ordering', 'questions')
			),
		);
	}

    public function addPostAction() {
        $row = $this->getAddData();
        $row['question_types'] = implode(',', $row['question_types']);
        if($this->validateAddData($row)) {
            $this->add($row);
            pzk_notifier()->addMessage('Thêm thành công');
            $this->redirect('index');
        } else {
            pzk_validator()->setEditingData($row);
            $this->redirect('add');
        }
    }

    public function editPostAction() {
        $row = $this->getEditData();
        
        $id = pzk_request()->get('id');
		
        if($this->validateEditData($row)) {
            $data = _db()->useCB()->select('img')->from('categories')->where(array('id', $id))->result_one();
            if(($row['img'] != $data['img']) and !empty($data['img'])) {
                $url = BASE_DIR.$data['img'];
                unlink($url);
            }
            $this->edit($row);
            pzk_notifier()->addMessage('Cập nhật thành công');
            $this->redirect('index');
        } else {
            pzk_validator()->setEditingData($row);
            $this->redirect('edit/' . pzk_request('id'));
        }
    }

    public function delPostAction() {
        $id = pzk_request()->get('id');
        $data = _db()->useCB()->select('img')->from($this->table)->where(array('id', $id))->result_one();
        if($data['img']) {
            unlink($data['img']);
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
                    $data = _db()->useCB()->select('img')->from($this->table)->where(array('id', $item))->result_one();
                    if($data['img']) {
                        $tam = explode("/",$data['img']);
                        $url2 = end($tam);
                        $url = BASE_DIR.$data['img'];
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