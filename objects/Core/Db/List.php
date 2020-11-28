<?php
class PzkCoreDbList extends PzkObject
{
	public $layout = 'db/list';
	public $layoutType = 'div';

	/**
	 * Cac dieu kien de lay du lieu
	 */
	public $table = 'news';
	public $fields = '*';
	public $conditions = '1';
	public $pageSize = 1000;
	public $pageNum = 0;
	public $pagination = false; // none, ajax
	public $orderBy = 'id desc';
	public $groupBy = false;
	public $having = false;
	public $processReport = false;
	public $status = 1;
	public $exportFields = false;
	public $filters = array();
	public $parentWhere = 'equal';

	/**
	 * Dieu kien theo parent
	 */
	public $parentId = false;
	public $parentMode = false;
	public $parentField = 'parentId';

	/**
	 * Cac truong can hien thi
	 */
	public $displayFields = 'title,content';
	public $titleTag = 'h3';
	public $contentTag = 'div';
	public $classPrefix = 'core_db_list_item_';

	public function init()
	{
		$this->setConditions(json_decode($this->getConditions(), true));
	}

	/**
	 * @param String|null $keyword
	 * @param array $fields filter keyword by fields
	 * @return array
	 */
	public function getItems($keyword = NULL, $fields = array())
	{
		$query = _db()->select($this->getFields())->from($this->getTable())
			->where($this->getConditions())
			//->where($this->status)
			->orderBy($this->getOrderBy())
			->limit($this->getPageSize(), $this->getPageNum())
			->groupBy($this->getGroupBy())
			->having($this->getHaving());
		if ($this->getJoins()) {
			foreach ($this->getJoins() as $join) {
				$query->join($join['table'], $join['condition'], isset($join['type']) ? $join['type'] : 'inner');
			}
		}
		if ($this->getParentMode() && $this->getParentMode() !== 'false') {
			if ($this->getParentId() === false) {
				$request = pzk_request();
				$this->parentId = $request->getSegment(3);
			}
			if ($this->getParentWhere() == 'like') {
				$query->where(array($this->getParentWhere(), $this->getParentField(), '%,' . $this->getParentId() . ',%'));
			} else {
				$query->where(array($this->getParentWhere(), $this->getParentField(), $this->getParentId()));
			}
		}
		if ($this->getFilters() && count($this->getFilters())) {

			foreach ($this->getFilters() as $filter) {
				$query->where($filter);
			}
		}
		if ($keyword && count($fields)) {
			$keyword = mysql_escape_string($keyword);
			$conds = array('or');
			foreach ($fields as $field) {
				$conds[] = array('like', $field, "%$keyword%");
			}
			$query->where($conds);
		}
		$this->prepareQuery($query);
		return $query->result();
	}

	public function stringQuery($keyword = NULL, $fields = array(), $isSelect = 0)
	{
		if ($isSelect) {
			$select = $this->fields;
		} else {
			$select = implode(',', $this->getExportFields());
		}
		$query = _db()->select($select)->from($this->getTable())
			->where($this->getConditions())
			->orderBy($this->getOrderBy())
			//->limit($this->pageSize, $this->pageNum)
			->groupBy($this->getGroupBy())
			->having($this->getHaving());
		if ($this->getFilters() && count($this->getFilters())) {
			foreach ($this->getFilters() as $filter) {
				$query->where($filter);
			}
		}
		if ($keyword && count($fields)) {
			$keyword = mysql_escape_string($keyword);
			$conds = array(C_OR);
			foreach ($fields as $field) {
				$conds[] = array(C_LIKE, $field, "%$keyword%");
			}
			$query->where($conds);
		}
		$this->prepareQuery($query);
		return $query->getQuery();
	}

	public function addFilter($index, $value, $filterType = 'equal')
	{
		if ($value == '') return $this;
		$value = mysql_escape_string($value);
		if ($filterType == 'like' && is_numeric($value)) {
			$this->filters[] = array($filterType, $index, '%,' . $value . ',%');
		} else {
			$this->filters[] = array($filterType, $index, $value);
		}

		return $this;
	}

	public function addCondition($str)
	{
		$this->conditions .= ' and ' . $str;
	}

	public function getCountItems($keyword = NULL, $fields = array())
	{
		$query = _db()->select('count(*) as c')
			->from($this->getTable())
			->where($this->getConditions())
			->groupBy($this->getGroupBy())
			->having($this->getHaving());
		if ($this->getJoins()) {
			foreach ($this->getJoins() as $join) {
				$query->join($join['table'], $join['condition'], isset($join['type']) ? $join['type'] : 'inner');
			}
		}
		if ($this->getParentMode() && $this->getParentMode() !== 'false') {
			if (!$this->getParentId()) {
				$request = pzk_request();
				$this->parentId = $request->getSegment(3);
			}
			if ($this->getParentWhere() == C_LIKE) {
				$query->where(array($this->getParentWhere(), $this->getParentField(), '%,' . $this->getParentId() . ',%'));
			} else {
				$query->where(array($this->getParentWhere(), $this->getParentField(), $this->getParentId()));
			}
		}
		if ($keyword && count($fields)) {
			$keyword = mysql_escape_string($keyword);
			$conds = array(C_OR);
			foreach ($fields as $field) {
				$conds[] = array(C_LIKE, $field, "%$keyword%");
			}
			$query->where($conds);
		}
		if ($this->filters && count($this->filters)) {
			foreach ($this->filters as $filter) {
				$query->where($filter);
			}
		}
		$this->prepareQuery($query);
		$row = $query->result_one();
		return $row['c'];
	}

	public function prepareQuery($query)
	{
	}

	public function getNameById($id, $table, $field)
	{
		$data = _db()->select('*')->from($table)->where(array('id', $id))->result_one();
		return $data[$field];
	}
	public function executeStringQuery($sql)
	{
		$data = _db()->query($sql);
		return $data;
	}
}
