<?php
class PzkCollectionModel extends PzkSG{
	public $entity = '';
	public function __construct(){
		$this->clear();
		$this->select('*');
	}
    /**
     * Join với table với điều kiện join, và kiểu join
     * @param string $table bảng cần join
     * @param mixed $conds điều kiện join
     * @param string $type kiểu join: inner, left, right, mặc định là inner
     * @return PzkCoreDatabase
     */
	public function join($table, $conds, $type = 'inner') {
		if(!isset($this->options['joins'])) {
			$this->options['joins'] = array();
		}
		$this->options['joins'][$table] = array('conds' => $this->buildCondition($conds), 'type' => $type);
		return $this;
	}
	
	public function leftJoin($table, $conds) {
		return $this->join($table, $conds, 'left');
	}
	
	public function rightJoin($table, $conds) {
		return $this->join($table, $conds, 'right');
	}
	
	/**
	 * Lệnh SELECT
	 * @param string $fields các trường, cách nhau bởi dấu phẩy ,
	 * @return PzkCoreDatabase
	 */
	public function select($fields) {
		$this->options['action'] = 'select';
		$this->options['fields'] = $this->prefixify($fields);
		return $this;
	}
	
	/**
	 * Add more fields to select
	 * @param string $fields
	 * @return PzkCoreDatabase
	 */
	public function addFields($fields) {
		if(!isset($this->options['fields']) || !$this->options['fields'])
			$this->select($fields);
		else
			$this->options['fields'] .= ',' . $this->prefixify($fields);
		return $this;
	}
	
	/**
	 * Lệnh FROM
	 * @param string $table
	 * @return PzkCoreDatabase
	 */
	public function from($table) {
		if (strpos($table, '`') !== false || preg_match('/^[\w\d_]/', $table) !== false) {
			$this->options['table'] = $this->prefixify($table);
		} else {
			$this->options['table'] = '`' . $this->prefixify($table) . '`';
		}
		return $this;
	}
	
	/**
	 * Lệnh WHERE
	 * @param mixed $conds điều kiện: là chuỗi hoặc là biểu thức dạng mảng
	 * @return PzkCoreDatabase
	 */
	public function where($conds) {
		$condsStr = $this->buildCondition($conds);
		$this->options['conds'] = pzk_or(isset($this->options['conds'])?$this->options['conds']: null, 1) . ' AND ' . $condsStr;
		return $this;
	}
	
	public function equal($col, $val) {
		return $this->where(array($col, $val));
	}
	
	/**
	 * Lệnh xây dựng điều kiện từ biểu thức dạng mảng
	 * @see PzkCoreDatabaseArrayCondition
	 * @param mixed $conds điều kiện
	 * @return string điều kiện sql
	 */
	public function buildCondition($conds) {
		$builder = pzk_element()->getConditionBuilder();
		if($builder) {
			return $this->prefixify($builder->build($conds));
		}
	}
	
	public function prefixify($str) {
		return str_replace('#', pzk_db()->prefix, $str);
	}
	
	/**
	 * Lọc dữ liệu theo mảng, dùng như where
	 * @param array $filters bộ lọc
	 * @return PzkCoreDatabase
	 */
	public function filters($filters) {
		if ($filters && is_array($filters)) {
			$this->where($filters);
		}
		return $this;
	}
	
	/**
	 * Sắp xếp thứ tự
	 * @param string $orderBy
	 * @return PzkCoreDatabase
	 */
	public function orderBy($orderBy) {
		$this->options['orderBy'] = $this->prefixify($orderBy);
		return $this;
	}
	
	/**
	 * Gom nhóm
	 * @param string $groupBy
	 * @return PzkCoreDatabase
	 */
	public function groupBy($groupBy) {
		if(!$groupBy) return $this;
		if(!isset($this->options['groupBy']) || !$this->options['groupBy']){
			$this->options['groupBy'] = $this->prefixify($groupBy);
		} else {
			$this->options['groupBy'] .= ', ' . $this->prefixify($groupBy);
		}
		return $this;
	}
	
	/**
	 * Điều kiện having
	 * @param mixed $conds
	 * @return PzkCoreDatabase
	 */
	public function having($conds) {
		if(!$conds) return $this;
		if (isset($this->options['groupBy'])) {
			$condsStr = $this->buildCondition($conds);
			$this->options['having'] =  pzk_or(isset($this->options['having'])?$this->options['having']: null, 1) . ' AND ' . $condsStr;;
		}
		return $this;
	}
	
	public function clear() {
		$this->options = array();
		return $this;
	}
	
	/**
	 * Thực thi query
	 * @param string $entity trả về mảng dạng entity hay dạng mảng thông thường
	 * @return NULL|array|array<PzkEntityModel>
	 */
	public function result($entity = false) {
		if(!$entity) $entity = $this->entity;
		return $this->executeSelectQuery($entity);
	}
	
	public function executeSelectQuery($entity = false) {
		$rslt = array();
		
		$query = null;
		$cacheKey = false;
		if(CACHE_MODE && $this->isUsingCache()) {
			if(isset($this->options['cacheKey'])) {
				$cacheKey = md5($_SERVER['HTTP_HOST'] .$this->options['cacheKey'] . $entity);
			} else {
				$query = $this->getSelectQuery();
				$cacheKey = md5($_SERVER['HTTP_HOST'] .$query . $entity);
			}
			
			$cacher = NULL;
			if(1 && defined('CACHE_DEFAULT_CACHER')) {
				$cacher = CACHE_DEFAULT_CACHER;
			} else {
				$cacher = 'pzk_filecache';
			}
			
			
			$data = $cacher()->get($cacheKey, isset($this->options['cacheTimeout'])? $this->options['cacheTimeout']: null);
						
			if($data !== NULL && $data !== '' && !!$data) {
				$data = unserialize($data);
				if($entity) {
					$rsltEntity = array();
					foreach($data as $item) {
						$entityObj = _db()->getEntity($entity);
						$entityObj->setData($item);
						$rsltEntity[] = $entityObj;
					}
					return $rsltEntity;
				}
				return $data;
			}
		}
		
		$this->connect();
		if(!$query) $query = $this->getSelectQuery();
		if(DEBUG_MODE)
			$this->addToDebug($query);
		$result = mysqli_query($this->connId, $query);
		
		$this->verifyError($query);
		$rsltEntity = array();
		while ($row = mysqli_fetch_assoc($result)) {
			if(isset($row['params']) && $row['params']) {
				$params = json_decode($row['params'], true);
				$row = array_merge($row, $params);
			}
			if($entity) {
				$entityObj = pzk_loader()->createModel('entity.' . $entity);
				$entityObj->setData($row);
				$rslt[] = $entityObj;
				if(CACHE_MODE && $this->isUsingCache()) {
					$rsltEntity[] = $row;
				}
			} else {
				$rslt[] = $row;
			}
		}
		mysqli_free_result($result);
		if(CACHE_MODE && $this->isUsingCache()) {
			$cacher = NULL;
			if(defined('CACHE_DEFAULT_CACHER')) {
				$cacher = CACHE_DEFAULT_CACHER;
			} else {
				$cacher = 'pzk_filecache';
			}
			if($entity) {
				$cacher()->set($cacheKey, serialize($rsltEntity));
			} else {
				$cacher()->set($cacheKey, serialize($rslt));
			}
			
		}
		return $rslt;
	}
	
	public function getSelectQuery() {
		// neu bang co truong software thi
			// them dieu kien loc where software $this->where();
		if(!$this->hasSoftwareConditions()) {
			$softwareConds = $this->getSoftwareConditions();
			if($softwareConds) {
				$this->and_($softwareConds);
			}
			$this->markHavingSoftwareConditions();
		}
		
		$query = 'select ' . $this->options['fields']
				. ' from ' . $this->prefix . $this->options['table'];
		if(isset($this->options['joins'])) {
			$joins = $this->options['joins'];
			foreach($joins as $table => $join) {
				$query.= ' ' . $join['type'] . ' join ' . $this->prefix . $table . ' on ' . $join['conds'];
			}
		}
		$query .= ((isset($this->options['conds']) && $this->options['conds']) ? ' where ' . $this->options['conds'] : '')
				. (isset($this->options['groupBy']) && $this->options['groupBy'] ? ' group by ' . $this->options['groupBy'] : '')
				. (isset($this->options['having']) && $this->options['having'] ? ' having ' . $this->options['having'] : '')
				. (isset($this->options['orderBy']) && $this->options['orderBy'] ? ' order by ' . $this->options['orderBy'] : '')
				. (isset($this->options['pagination']) && $this->options['pagination'] ?
						' limit ' . $this->options['start'] . ', '
						. $this->options['pagination'] : '');
		return $query;
	}
	
	public function hasSoftwareConditions() {
		return isset($this->options['hasSoftwareConditions']) && $this->options['hasSoftwareConditions'];
	}
	
	public function markHavingSoftwareConditions() {
		$this->options['hasSoftwareConditions'] = true;
	}
	
	public function verifyError($query = false) {
		if (mysqli_errno(pzk_db()->connId)) {
			$message = 'Invalid query: ' . mysqli_error(pzk_db()->connId) . "\n";
			$message .= 'Whole query: ' . $query;
			echo ($message);
		}
	}
	
	public function isUsingCache() {
		return isset($this->options['useCache']) && $this->options['useCache'];
	}
	
	public function getSoftwareConditions() {
		$table = $this->getTable();
		$tablefields = $this->getTableFields();
		if(in_array('software', $tablefields)) {
			$softwareId = pzk_request()->getSoftwareId();
			
			$softwareConds = "`$table`.`software`=$softwareId";
			if(in_array('global', $tablefields)) {
				$globalConds = "`$table`.`global`=1";
				$softwareConds = $softwareConds . ' or ' . $globalConds;
			}
			if(in_array('sharedSoftwares', $tablefields)) {
				$sharedConds = "`$table`.`sharedSoftwares` like '%,$softwareId,%'";
				$softwareConds = $softwareConds . ' or ' . $sharedConds;
			}
			
			if(in_array('site', $tablefields)) {
				$siteId = pzk_request()->getSiteId();
				if($siteId) {
					$softwareConds = "($softwareConds) and (`$table`.`site`=$siteId or `$table`.`site`=0)";
				} else {
					$softwareConds = "($softwareConds) and (`$table`.`site`=0)";
				}
			}
			
			return $softwareConds;
		}
		
		return null;
	}
	
	public function getTable() {
		$table = str_replace('`', '', $this->options['table']);
		$tmp = preg_split('/[\. ]/', $table);
		$table = end($tmp);
		return $table;
	}
	
	public $_tableFields = array();
	public function getTableFields() {
		
		$table = $this->options['table'];
		if(!isset($this->_tableFields[$table])) {
			$fields = pzk_db()->getFields($table);
			$this->_tableFields[$table] = $fields;
		}
		return $this->_tableFields[$table];
	}
	
	public function __call($name, $arguments) {

		//Getting and setting with $this->property($optional);

		if (property_exists(get_class($this), $name)) {


			//Always set the value if a parameter is passed
			if (count($arguments) == 1) {
				/* set */
				$this->$name = $arguments[0];
			} else if (count($arguments) > 1) {
				throw new \Exception("Setter for $name only accepts one parameter.");
			}

			//Always return the value (Even on the set)
			return $this->$name;
		}

		//If it doesn't chech if its a normal old type setter ot getter
		//Getting and setting with $this->getProperty($optional);
		//Getting and setting with $this->setProperty($optional);
		$prefix6 = substr($name, 0, 6);
		$property6 = strtolower(isset($name[6])?$name[6]: '') . substr($name, 7);
		$prefix5 = substr($name, 0, 5);
		$property5 = strtolower(isset($name[5])?$name[5]: '') . substr($name, 6);
		$prefix4 = substr($name, 0, 4);
		$property4 = strtolower(isset($name[4])?$name[4]: '') . substr($name, 5);
		$prefix3 = substr($name, 0, 3);
		$property3 = strtolower(isset($name[3])?$name[3]: '') . substr($name, 4);
		$prefix2 = substr($name, 0, 2);
		$property2 = strtolower(isset($name[2])?$name[2]: '') . substr($name, 3);
		switch ($prefix6) {
			case 'select':
			if($property6 == 'all') {
				return $this->select('*');
			}
			if($property6 == 'none') {
				return $this->select('');
			}
			return $this->addFields(str_replace('__', '.', $property6));
			break;
		}
		switch ($prefix5) {
			case 'where':
				return $this->where(array($property5, $arguments[0]));
				break;
			case 'equal':
				return $this->where(array('equal', $property5, $arguments[0]));
				break;
			case 'nlike':
				return $this->where(array('notlike', $property5, $arguments[0]));
				break;
			case 'notin':
				return $this->where(array('notin', $property5, $arguments[0]));
				break;
			case 'isnull':
				return $this->where(array('isnull', $property5, $arguments[0]));
				break;
			case 'nnull':
				return $this->where(array('isnotnull', $property5, $arguments[0]));
				break;
			case 'ljoin':
				return $this->leftJoin($property5, $arguments[0]);
				break;
			case 'rjoin':
				return $this->rightJoin($property5, $arguments[0]);
				break;
		}
		switch ($prefix4) {
			case 'like':
				return $this->where(array('like', $property4, $arguments[0]));
				break;
			case 'from':
				return $this->from($property4);
				break;
			case 'join':
				return $this->join($property4, $arguments[0], isset($arguments[1])?$arguments[1]: null);
				break;
		}
		switch ($prefix3) {
			case 'gte':
				return $this->where(array('gte', $property3, $arguments[0]));
				break;
			case 'lte':
				return $this->where(array('lte', $property3, $arguments[0]));
				break;
		}
		switch ($prefix2) {
			case 'gt':
				return $this->where(array('gt', $property2, $arguments[0]));
				break;
			case 'lt':
				return $this->where(array('lt', $property2, $arguments[0]));
				break;
			case 'in':
				return $this->where(array('in', $property2, $arguments[0]));
				break;
		}
		return parent::__call($name, $arguments);
	}
}