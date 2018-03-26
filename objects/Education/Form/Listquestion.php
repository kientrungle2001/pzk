<?php 
class PzkEducationFormListquestion extends PzkObject {
	public $table = 'questions';
	
	public function getQuestion($lessonId) {
		
		$data =_db()->useCB()
            ->select('*')
            ->from($this->table)
            ->where(array('like', 'categoryIds', '%,'.$lessonId.',%'))
            ->result();

        return $data;
	}
	public function getTypeByCateId($lessonId) {
		
		$data =_db()->useCB()
            ->select('*')
            ->from('categories')
            ->where("id = $lessonId")
            ;
		//echo $data->getQuery();
        return $data->result_one();
	}
}
?>