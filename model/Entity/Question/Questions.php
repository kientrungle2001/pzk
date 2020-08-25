<?php
require_once BASE_DIR . '/model/Entity.php';
class PzkEntityQuestionQuestionsModel extends PzkEntityModel {
	public $table = 'questions';
	public function getQuestionType() {
		// Begin dang ve Từ
		// Điền càng nhiều đáp án càng tốt
		if($this->getType() == 'Q2' || $this->getType() == 'Q3' || $this->getType() == 'Q5' || $this->getType() == 'Q6') {
			return 'fill';
		}
		// Trắc nghiệm
		if($this->getType() == 'Q0'|| $this->getType() == 'Q4') {
			return 'choice';		}
		// Chữa lỗi sai( học sinh điền từ sai và điền đáp án đúng)
		if($this->getType() == 'Q1') {
			return 'repair';		}
		// Tìm từ theo chủ đề ( cho đoạn văn và các chủ đề. tìm các từ trong đoạn văn thuộc chủ đề đó)
		if($this->getType() == 'Q7') {
			return 'topic';		}
		// End dạng về Từ
		// Begin Dạng về Câu
		// chọn đáp án sai và sửa lại cho đúng
		if($this->getType() == 'Q8') {
			return 'choicerepair';		
		}
		// Viết tiếp câu
		if($type == 'Q9' || $type == 'Q10'|| $type == 'Q12' ) {
			return 'addsentence';		
		}
		if($type == 'Q11' || $type == 'Q13'|| $type == 'Q14' ) {
			return 'writesentence';		
		}
		if($type == 'Q15' || $type == 'Q16'|| $type == 'Q17' ) {
			return 'rewritesentence';		
		}
		// End dạng về Câu
		// Begin dạng về đoạn văn
		// Đặt tên cho đoạn văn
		if($type == 'Q18' ) {
			return 'nameparagraph';		
		}
		// Đặt tên cho từng đoạn văn
		if($this->getType() == 'Q25') {
			return 'name';		}
		// End dạng về đoạn văn
		return 'fill';
	}

	public function getRealEntity() {
		$realEntity = _db()->getEntity('Question.' . $this->getQuestionType());
		$realEntity->setData($this->getData());
		return $realEntity;
	}
}