<?php
pzk_model('Entity.Collection');
class PzkEntityCollectionTestsModel extends PzkEntityCollectionModel {
	public $table = 'tests';
	public function filterTeacherId($teacherId) {
		return $this->filterLike('teacherIds', $teacherId);
	}
}