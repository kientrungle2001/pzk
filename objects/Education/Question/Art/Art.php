<?php
class PzkEducationQuestionArtArt extends PzkObject {
	public $layout = 'question/art/art';
	public $CategoryId = false;


	public function showQuestion(){
		$rs = _db()->useCB()->select('*')->from('questions')
		->where(array('level',$this->getLevel()))
		->likeCategoryIds('%,'.$this->getCategoryId().',%')
		->orderBy('RAND()')
		->limit($this->getQuantity(),0)
		->result();
		return $rs;
	}
	public function getType($questionId){
		$rs= _db()->useCB()->select('type')->from('questions')->where(array('id',$questionId))->result_one();
		return $rs['type'];
	}

	public function numPage(){
		$quantity= $this->getQuantity();
		$numpage= ceil($quantity/3);
		return $numpage;
	}
	public function checkLevel($level){
		switch ($level) {
            case 1:
            	return "Dễ";
            	break;
            case 2:
                return "Bình thường";
                break;
            case 3:
                return "Khó";
                break;
        }
	}
	public function getQuestionType($type) {
		// Begin dang ve Từ
		// Điền càng nhiều đáp án càng tốt
		if($type == 'Q2' || $type == 'Q3' || $type == 'Q5' || $type == 'Q6') {
			return 'fill';
		}
		// Trắc nghiệm
		if($type == 'Q0'|| $type == 'Q4') {
			return 'choice';		}
		// Chữa lỗi sai( học sinh điền từ sai và điền đáp án đúng)
		if($type == 'Q1') {
			return 'repair';		}
		// Tìm từ theo chủ đề ( cho đoạn văn và các chủ đề. tìm các từ trong đoạn văn thuộc chủ đề đó)
		if($type == 'Q7') {
			return 'topic';		}
		// End dạng về Từ
		// Begin Dạng về Câu
		// chọn đáp án sai và sửa lại cho đúng
		if($type == 'Q8') {
			return 'choicerepair';		
		}
		// Viết tiếp câu
		if($type == 'Q9' || $type == 'Q10') {
			return 'addsentence';		
		}
		// End dạng về Câu
		// Begin dạng về đoạn văn
		// Đặt tên cho từng đoạn văn
		if($type == 'Q25') {
			return 'name';		}
		// End dạng về đoạn văn
		return 'fill';
	}

}