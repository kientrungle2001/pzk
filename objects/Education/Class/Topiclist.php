<?php
pzk_loader()->importObject('core/db/List');

class PzkEducationClassTopiclist extends PzkCoreDbList {
	public function getSubjects($id) {
		$data =_db()->useCB()
            ->select('*')
            ->from('categories')
            ->where(array('parent', $id))
			->limit(5)
            ->result();

        return $data;
	}
	
	public function getTests($class) {
		$data =_db()->useCB()
            ->select('*')
            ->from('tests')
			->likeClasses('%,'.$class.',%')
			->limit(5)
            ->result();

        return $data;
	}
}
?>