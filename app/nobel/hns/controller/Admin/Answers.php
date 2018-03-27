<?php
class PzkAdminAnswersController extends PzkAdminController {
	public $masterStructure = 'admin/home/index';
	public $masterPosition = 'left';
	public $addFields = 'questionId, value, valueTrue';
	public $editFields = 'questionId, value, valueTrue';
	public $logable = true;
	public $logFields = 'questionId, value, valueTrue';
	public function editPostAction() {
		$row = $this->getEditData();
		$this->edit($row);
		pzk_request()->redirect('admin_questions/detail/' . $row['questionId']);
	}
	public function addAction() {
		$this->initPage()
			->append('admin/'.$this->module.'/add')
			->append('admin/'.$this->module.'/menu', 'right');
		pzk_element('addForm')->(pzk_request()->getSegment(3));
		$this->display();
	}
	public function addPostAction() {
		$row = $this->getAddData();
		$this->add($row);
		pzk_request()->redirect('admin_questions/detail/' . $row['questionId']);
	}
	public function delPostAction() {
		$row = _db()->select('*')->from($this->table)
			->where(array('id' => pzk_request()->get('id')))
			->result_one();
		_db()->useCB()->delete()->from($this->table)
			->where(array('id', pzk_request()->get('id')))->result();
		pzk_notifier()->addMessage('Xóa thành công');
		pzk_request()->redirect('admin_questions/detail/' . $row['questionId']);
	}
}