<?php
if (!class_exists('PzkEntityModel')) {
	class PzkEntityModel extends PzkSG
	{
		public $data = array();
		public $table;
		public $type = '';
		/**
		 * set data for entity
		 * @param Array $data mảng dữ liệu truyền vào
		 * @return PzkEntityModel $this
		 */
		public function setData($data)
		{
			$this->data = $data;
			return $this;
		}
		/**
		 * get data as array
		 * @return Array data
		 */
		public function getData()
		{
			return $this->data;
		}

		/**
		 * load data from database by id
		 * @param Integer $id id
		 * @param Integer $cacheTimeout seconds to cached
		 * @return PzkEntityModel $this
		 */
		public function load($id = false, $cacheTimeout = NULL)
		{
			if ($id) {
				$query = _db();
				if ($cacheTimeout) {
					$query->useCache($cacheTimeout);
					$query->useCacheKey('entity-' . $this->table . '-' . $id);
				}
				$this->data = $query->select('*')->from($this->table)->whereId($id)->result_one();
				if (0) {
					$options = _db()->select('*')->from('table_option')
						->whereItemId($id)
						->whereTable($this->table)
						->result();
					foreach ($options as $option) {
						$this->data[$option['name']] = $option['value'];
					}
				}
			}
			return $this;
		}

		/**
		 * Load data by conditions
		 * @param Array|String $conditions điều kiện
		 * @param Integer $cacheTimeout thời gian cache
		 * @return PzkEntityModel $this
		 */
		public function loadWhere($conditions, $cacheTimeout = NULL)
		{
			if ($conditions) {
				$query = _db();
				if ($cacheTimeout) {
					$query->useCache($cacheTimeout);
				}
				$this->data = $query->useCB()->select('*')->from($this->table)->where($conditions)->result_one();
				if ($this->data) {
					if (0) {
						$options = _db()->select('*')->from('table_option')
							->whereItemId($this->data['id'])
							->whereTable($this->table)
							->result();
						foreach ($options as $option) {
							$this->data[$option['name']] = $option['value'];
						}
					}
				}
				//echo $query->getQuery();
			}
			return $this;
		}

		/**
		 * update dữ liệu cho entity
		 * @param Array $data dữ liệu cần update
		 * @return PzkEntityModel 
		 */
		public function update($data)
		{
			$this->data = array_merge($this->data, $data);
			foreach ($data as $key => &$value) {
				if ($value === NULL) {
					$value = '';
				}
			}
			$fields = _db()->getFields($this->table);
			if (in_array('params', $fields))
				$data = _db()->buildInsertData($this->table, $this->data);
			else
				$data = _db()->buildInsertData($this->table, $this->data);
			_db()->update($this->table)->set($data)->whereId($this->getId())->result();
			return $this;
		}

		/**
		 * Lưu entity
		 * @return PzkEntityModel $this
		 */
		public function save()
		{
			$data = _db()->buildInsertData($this->table, $this->data);
			if (!isset($this->data['id']) || !$this->data['id']) {
				$keys = array_keys($data);
				foreach ($keys as &$key) {
					$key = "`$key`";
				}
				$id = _db()->insert($this->table)->fields(implode(',', $keys))->values(array($data))->result();
				if ($id) $this->setId($id);
			} else {
				//check lock field
				if ($this->isLock()) {
					return false;
				} else {
					_db()->update($this->table)->set($data)->where(array('id', $this->getId()))->result();
					return true;
				}
			}
			$fields = _db()->getFields($this->table);
			if (in_array('parents', $fields))
				$this->children('updateParents');
			//$this->updateParents();
			return $this;
		}

		public function updateParents()
		{
			if (isset($this->data['parent'])) {
				$parent = $this->data['parent'];
				if ($parent) {
					$class = get_class($this);
					$obj = new $class();
					$obj->table = $this->table;
					$obj->load($parent);
					$parents = $obj->getParents() . $this->getId() . ',';
				} else {
					$parents = ',' . $this->getId() . ',';
				}
				$this->data['parents'] = $parents;
				$parentsData = array(
					'parents' => $parents
				);
				$this->update($parentsData);
			}
			return $this;
		}

		public function getRelateds($table, $entity, $refField, $conditions = false)
		{
			$query = _db()->select('*')->from($table)->where($refField . '=' . $this->data['id']);
			if ($conditions) {
				$query->useCB()->where($conditions);
			}
			return $query->result($entity);
		}
		/*
	public function getType() {
		$typeCode = $this->type;
		if(!$typeCode) $typeCode = str_replace('_', '', $this->table) . 'Table';
		$type = _db()->useCB()->select('*')->from('attribute_catalog_type')
				->where(array('and', array('sourceTable', $this->table), array('code', $typeCode)))->result_one('attribute.catalog.type');
		return $type;
	}*/

		public function get($key, $default = NULL)
		{
			return isset($this->data[$key]) && $this->data[$key] ? $this->data[$key] : $default;
		}

		public function set($key, $value)
		{
			$this->data[$key] = $value;
			return $this;
		}

		public function has($key)
		{
			return isset($this->data[$key]);
		}

		public function children($action = false)
		{
			if ($action) {
				if (gettype($action) == 'string') {
					if (method_exists($this, $action)) {
						$this->$action();
					} else {
						$action($this);
					}
				} else if (gettype($action) == 'object') {
					$action->process($this);
				}
			}

			$children = $this->getWhere(array('parent', $this->getId()));
			foreach ($children as $child) {
				$child->children($action);
			}
		}

		public function delete()
		{
			if ($this->isLock()) {
				return false;
			} else {
				return _db()->useCB()->delete()->from($this->table)
					->where(array('id', $this->getId()))->result();
			}
		}
		public function isLock()
		{
			//check lock field
			$listFields = _db()->getFields($this->table);
			if (!in_array('lock', $listFields)) {
				return false;
			}
			if ($this->hasLock()) {
				if ($this->getLock()) {
					return true;
				} else {
					return false;
				}
			}
			$entity = _db()->getEntity('Table')->setTable($this->table);
			$entity->load($this->getId());
			if ($entity->getLock() == 1) {
				return true;
			} else {
				return false;
			}
		}
		public function getWhere($where = 1, $orderBy = 'id asc')
		{
			$arr = array();
			$class = get_class($this);
			$items = _db()->useCB()->select('*')->from($this->table)->where($where)->orderBy($orderBy)->result();
			foreach ($items as $item) {
				$entity = new $class();
				$entity->table = $this->table;
				$entity->setData($item);
				$arr[] = $entity;
			}
			return $arr;
		}
		public function getOne($where = 1, $orderBy = 'id asc')
		{
			$item = _db()->useCB()->select('*')->from($this->table)->where($where)->orderBy($orderBy)->result_one();
			if ($item) {
				$class = get_class($this);
				$entity = new $class();
				$entity->table = $this->table;
				$entity->setData($item);
				return $entity;
			}
			return null;
		}
	}
}
