<?php
class PzkAdminCategoryController extends PzkGridAdminController {
	public $table = 'categories';
	public $addFields = 'name, name_vn, name_en, parent, router, img, trial, status, display, software, content, recommend, extotal, isSort, alias';
	public $editFields = 'name, name_vn, name_en, parent, router, img, trial, status, display, software, content, recommend, extotal, isSort, alias';
	
	public function getFilterFields() {
		return PzkEditConstant::gets('parentOfCategory, status', 'categories');
	}
	public function getListFieldSettings() {
		return PzkListConstant::gets('ordering, name, name_vn, name_en, alias, router, extotal, import, trial, status, isSort, display', 'categories');
	}

    public $searchFields = array('name');
    public $searchLabel = 'Tên';

    //sort by
    public function getSortFields() {
    	return PzkSortConstant::gets ( 'id, ordering, name', 'categories' );
    }

	public $logable = true;
	public $logFields = 'name, name_vn, name_en, alias, router, keywords, description';
	public $addLabel = 'Thêm Danh mục';

	public function getAddFieldSettings() {
		return PzkEditConstant::gets('nameOfCategory, name_vn, name_en, extotal, alias, router, parent, 
				content, recommend, img, trial, status, isSort, display, keywords, description', 'categories');
	}
	public function getEditFieldSettings() {
		return PzkEditConstant::gets('nameOfCategory, name_vn, name_en, extotal, alias, router, parent, 
				content, recommend, img, trial, status, isSort, display, keywords, description', 'categories');
	}

	public function getAddValidator() {
		return PzkValidatorConstant::gets(
			array(
				'name' => array(
					'required' => true, 'minlength' => 2, 'maxlength' => 500
				)
			)
		);
	}
    
    public function getEditValidator() {
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

    public function editPostAction() {
        $row = $this->getEditData();
        $id = pzk_request()->getId();

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
        $id = pzk_request()->getId();
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

	public function assertEqual($val, $expected) {
		static $index = 1;
		echo $index . '. ';
		if($val == $expected) {
			echo "Passed<br />";
		} else {
			echo "Not Passed: $val != $expected<br />";
		}
		$index++;
	}

	public function importQuestionsPostAction() {
		set_time_limit(0);
		$content = pzk_request()->getContent();
		file_put_contents(BASE_DIR . '/tmp/cauhoi.txt', $content);
		echo 'Import dữ liệu<br />';
		$categoryId = pzk_request()->getSegment(3);
		$model = _db()->getEntity('Import.Category');
		$model->load($categoryId);
		$model->setFilePath(BASE_DIR . '/tmp/cauhoi.txt');
		$model->import();
		//$this->assertEqual(count($model->getQuestions()), 15);
		$questions = $model->getQuestions();
		$totalAnswers = 0;
		$categoryIds = $model->getCategoryIds();
		foreach($questions as $question) {
			$question->import();
			$answers = $question->getAnswers();
			if(!count($answers)) continue;
			//$existed = $question->getOne(array('name', $question->getName()));
			$answerQuestion1 = _db()->select('*')->from('answers_question_tn')
				->join('questions', 'answers_question_tn.question_id = questions.id')
				->where(array('and', 
					array('equal', array('column', 'questions', 'name'), $question->getName()), 
					array('equal', array('column', 'answers_question_tn', 'content'), $answers[0]->getContent())));
			$answerQuestion1 = $answerQuestion1->result_one('table');
			$answerQuestion2 = _db()->select('*')->from('answers_question_tn')
				->join('questions', 'answers_question_tn.question_id = questions.id')
				->where(array('and', 
					array('equal', array('column', 'questions', 'name'), $question->getName()), 
					array('equal', array('column', 'answers_question_tn', 'content'), $answers[0]->getContent())));
			$answerQuestion2 = $answerQuestion2->result_one('table');
			if($answerQuestion1 && $answerQuestion1->getId() && $answerQuestion2 && $answerQuestion2->getId()) {				
				echo $answerQuestion1->getName() . ' đã tồn tại<br />';
				continue;
			}
			$question->setCategoryIds($categoryIds);
			$question->setCreated(date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']));
			$question->setCreatedId(pzk_session()->getadminId());			
			$question->setSoftware(pzk_request()->getSoftwareId());			
			$question->setQuestionType(1);
			$question->save();
						
			if($question->getId()) {
				echo 'Question imported: ' . $question->getName() . '<br />';			
			}
			foreach($answers as $answer) {
				$answer->setQuestion_id($question->getId());
				$answer->setDate_modify(date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']));
				$answer->setAdmin_modify(pzk_session()->getadminId());
				$answer->save();
			}
			$totalAnswers += count($answers);
		}
		//$this->assertEqual($totalAnswers, 60);
		echo '<a href="/Admin_Category/index">Danh mục</a><br />';
		echo '<a href="/Admin_Question2/index">Câu hỏi</a><br />';
		echo '<a href="/Admin_Category/importQuestions/'.$categoryId.'">Tiếp tục import vào danh mục</a>';
	}
	
	public function importQuestionsAction() {
		$this->initPage()
			->append('admin/category/importQuestions')
			->append('admin/'.pzk_or($this->customModule, $this->module).'/menu', 'right')
			->display();
	}
}