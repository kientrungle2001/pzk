<?php
class PzkUpdationModel{
	public function __construct(){
		$this->clear();
	}
	
	public function clear() {
		$this->options = array();
		return $this;
	}
	
	    /**
     * Lệnh cập nhật
     * @param string $table
     * @return PzkCoreDatabase
     */
    public function update($table) {
        $this->options['action'] = 'update';
        $this->options['table'] = $table;
        return $this;
    }

    /**
     * Lệnh đặt giá trị cho cập nhật
     * @param string $values: giá trị dạng array('trường' => 'giá trị')
     * @return PzkCoreDatabase
     */
    public function set($values) {
        $this->options['values'] = $values;
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
	
	public function result() {
		if (isset($this->options['action']) && $this->options['action'] == 'update') {
            $columns = pzk_db()->describle($this->options['table']);
            $vals = array();
            $this->options['values']['software'] = pzk_request('softwareId');
            foreach ($this->options['values'] as $key => $value) {

                if (in_array($key, $columns)) {
                    $vals[] = '`'.$key . '`=\'' . @mysql_escape_string($value) . '\'';
                }
            }
            $values = implode(',', $vals);
            $query = "update `".pzk_db()->prefix."{$this->options['table']}` set $values where {$this->options['conds']}";
            $result = mysqli_query(pzk_db()->connId, $query);
            if (mysqli_errno(pzk_db()->connId)) {
                $message = 'Invalid query: ' . mysqli_error(pzk_db()->connId) . "\n";
                $message .= 'Whole query: ' . $query;
                pzk_notifier_add_message($message, 'danger');
            }
			return $result;
        }
	}
}