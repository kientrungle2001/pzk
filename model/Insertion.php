<?php
class PzkInsertionModel extends PzkSG{
	public function __construct(){
		$this->clear();
	}
	/**
     * Chèn vào bảng
     * @param string $table
     * @return PzkCoreDatabase
     */
    public function insert($table) {
        $this->options['action'] = 'insert';
        $this->options['table'] = "$table";
        return $this;
    }

    /**
     * Giá trị cần chèn vào bảng
     * @param array $values: dạng array($row1, $row2), trong đó $row1 là giá trị bản ghi
     * @return PzkCoreDatabase
     */
    public function values($values) {
        $this->options['values'] = $values;
        return $this;
    }

    /**
     * Các trường cần insert vào
     * @param string $fields dạng chuỗi, cách nhau bởi dấu ,
     * @return PzkCoreDatabase
     */
    public function fields($fields) {
        $this->options['fields'] = $fields;
        return $this;
    }
	
	public function clear() {
		$this->options = array();
		return $this;
	}
	
	public function result() {
		if (isset($this->options['action']) && $this->options['action'] == 'insert') {

			if(!isset($this->options['fields']) || !$this->options['fields']) {
				$this->options['fields'] = implode(',', pzk_db()->getFields($this->options['table']));
			}
            $vals = array();
            $columns = explode(',', $this->options['fields']);
            foreach ($this->options['values'] as $value) {
                $value['software'] = pzk_request()->getSoftwareId();
                $colVals = array();
                foreach ($columns as $col) {
					$col = trim($col);
                    $col = str_replace('`', '', $col);
                    $colVals[] = "'" . @mysql_escape_string(isset($value[$col])?$value[$col]: '') . "'";
                }
                $vals[] = '(' . implode(',', $colVals) . ')';
            }
            $table = $this->options['table'];
            $fields = $this->options['fields'];

            $values = implode(',', $vals);
            $query = "insert into `" . pzk_db()->prefix . "$table`($fields) values $values";
            $result = mysqli_query(pzk_db()->connId, $query);
            if (mysqli_errno(pzk_db()->connId)) {
                $message = 'Invalid query: ' . mysqli_error(pzk_db()->connId) . "\n";
                $message .= 'Whole query: ' . $query;
                pzk_notifier_add_message($message, 'danger');
            }
            if ($result) {
				$insertId = mysqli_insert_id(pzk_db()->connId);
                return $insertId;
            }
            return 0;
        }
	}
}