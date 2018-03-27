<?php 
/**
* 
*/
class PzkEntityImportCategoryModel extends PzkEntityModel
{
	public $table = "categories";
	public function import($content = false) {
		$questions = array();
		if(!$content)
		$content = file_get_contents($this->get('filePath'));
		$this->set('content', $content);
		$questionContents = explode('-----', $content);
		foreach($questionContents as $questionContent) {
			if(trim($questionContent)) {
				$question = _db()->getEntity('Import.Question.Split');
				$question->set('content', $questionContent);
				$questions[] = $question;
			}
		}
		$this->set('questions', $questions);
	}
	
	public function getCategoryIds() {
		$parent = $this;
		$categoryIds = array();
		$categoryIds[] = $parent->get('id');
		while($parent = $parent->getParentEntity()) {
			$categoryIds[] = $parent->get('id');
		}
		$categoryIds = array_reverse($categoryIds);
		return ',' . implode(',', $categoryIds) . ',';
	}
	
	public function getParentEntity() {
		if(!$this->get('parent')) return null;
		$parent = $this->getOne(array('id', $this->get('parent')));
		return $parent;
	}
}
 ?>