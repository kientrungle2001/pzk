<?php
class PzkEntityCollectionModel {
	public $table = 'news';
	public $fields = '*';
	public $conds = array('and', '1');
	public $orderBy = 'id asc';
	public function isOrdering() {
		$this->orderBy = 'ordering asc';
		return $this;
	}
	public function filter($field, $operator = null, $value = null) {
		if(null === $value) {
			if(null === $operator) {
				$this->conds[] = $field;
			} else {
				$value = $operator;
				$operator = 'equal';
				$this->conds[] = array($operator, $field, $value);
			}
		} else {
			$this->conds[] = array($operator, $field, $value);
		}
		return $this;
	}
	public function filterLike($field, $value) {
		return $this->filter($field, 'like', '%,'.$value.',%');
	}
	public function filterEnabled() {
		return $this->filter('status', 1);
	}
	public function filterCategoryId($categoryId) {
		return $this->filterLike('categoryIds', $categoryId);
	}
	public function filterTrial() {
		return $this->filter('trial', 1);
	}
	public function filterPractice() {
		return $this->filter('practice', 1);
	}
	public function filterType($type) {
		return $this->filter('type', $type);
	}
	public function filterSubject() {
		return $this->filterType('subject');
	}
	public function query() {
		$query = _db()->select($this->fields)->from($this->table);
		$query->where($this->conds);
		$query->orderBy($this->orderBy);
		return $query;
	}
}