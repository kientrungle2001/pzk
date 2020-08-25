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
		$content = file_get_contents($this->getFilePath());
		$this->setContent($content);
		$questionContents = explode('-----', $content);
		foreach($questionContents as $questionContent) {
			if(trim($questionContent)) {
				$question = _db()->getEntity('Import.Question.Split');
				$question->setContent($questionContent);
				$questions[] = $question;
			}
		}
		$this->setQuestions($questions);
	}
	
	public function getCategoryIds() {
		$parent = $this;
		$categoryIds = array();
		$categoryIds[] = $parent->getId();
		while($parent = $parent->getParentEntity()) {
			$categoryIds[] = $parent->getId();
		}
		$categoryIds = array_reverse($categoryIds);
		return ',' . implode(',', $categoryIds) . ',';
	}
	
	public function getParentEntity() {
		if(!$this->getParent()) return null;
		$parent = $this->getOne(array('id', $this->getParent()));
		return $parent;
	}
}
 ?>