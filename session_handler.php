<?php

class DBTable {
	public $table;
	public $conn;
	public function __construct($table, $conn) {
		$this->table = $table;
		$this->conn = $conn;
	}
	
	public function fetch($id) {
		$query = "select * from {$this->table} where id='$id' limit 0, 1";
		$result = mysqli_query($this->conn, $query);
		while($row = mysqli_fetch_assoc($result)) {
			return $row;
		}
		return null;
	}
	
	public function update($id, $data) {
		$values = array();
		foreach($data as $key => $value) {
			$value = $this->conn->escape_string($value);
			$values[] = "`$key` = '$value'";
		}
		$values = implode(',', $values);
		$query = "update {$this->table} set $values where id='$id'";
		$result = mysqli_query($this->conn, $query);
	}
	
	public function insert($data) {
		$fields = array();
		$values = array();
		foreach($data as $key => $value) {
			$value = $this->conn->escape_string($value);
			$fields[] = "`$key`";
			$values[] = "'$value'";
		}
		$fields = implode(',', $fields);
		$values = implode(',', $values);
		$query = "insert into {$this->table} ($fields) values($values)";
		$result = mysqli_query($this->conn, $query);
	}
	
	public function del($conds) {
		if(is_numeric($conds)) {
			$conds = "id='$conds'";
		}
		$query = "delete from {$this->table} where $conds";
		$result = mysqli_query($this->conn, $query);
	}
}

function DBTable($table) {
	static $conn;
	$conn = mysqli_connect('localhost', 'root', '', 'test');
	return new DBTable($table, $conn);
}

class DatabaseSessionHandler
{
    private $savePath;

    function open($savePath, $sessionName)
    {
        return true;
    }

    function close()
    {
        return true;
    }

    function read($id)
    {
		$row = DBTable('sessions')->fetch($id);
        return $row['content'];
    }

    function write($id, $data)
    {
		$row = DBTable('sessions')->fetch($id);
		if($row) {
			DBTable('sessions')->update($id, array('content' => $data));
		} else {
			DBTable('sessions')->insert(array('id' => $id, 'content' => $data, 'createdTime' => time()));
		}
		return true;
    }

    function destroy($id)
    {
        DBTable('sessions')->del($id);
        return true;
    }

    function gc($maxlifetime)
    {
		DBTable('sessions')->del('createdTime > '.  (time() - $maxlifetime));
        return true;
    }
}

$handler = new DatabaseSessionHandler();
session_set_save_handler(
    array($handler, 'open'),
    array($handler, 'close'),
    array($handler, 'read'),
    array($handler, 'write'),
    array($handler, 'destroy'),
    array($handler, 'gc')
    );

// the following prevents unexpected effects when using objects as save handlers
register_shutdown_function('session_write_close');
session_id(md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR'] . (isset($_SERVER["HTTP_X_FORWARDED_FOR"])?$_SERVER["HTTP_X_FORWARDED_FOR"]: '')  ));
session_start();
// proceed to set and retrieve values by key from $_SESSION

/*
$_SESSION['name'] = 'Kien';
*/
// unset($_SESSION['name']);