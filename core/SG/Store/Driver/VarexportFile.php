<?php
class PzkSGStoreDriverVarexportFile extends PzkSGStoreDriver {
	public $dir = 'cache';
	public function __construct($dir = 'cache') {
		$this->dir = $dir;
	}
	public function get($key, $timeout = null) {
		if (! isset($key) || !$key)
			return false;
		$fileName = BASE_DIR . '/' . $this->dir . '/' . md5 ( $key ) . '.php';
		
		if (! is_file ( $fileName )) {
			return NULL;
		}
		if ($timeout) {
			
			$remainingTime = - (time () - filemtime ( $fileName ) - $timeout);
			
			if ($remainingTime < 0) {
				unlink ( $fileName );
				return NULL;
			}
		}
		require $fileName;
		return $config[$key];
	}
	
	public function set($key, $value) {
		$data = array($key => $value);
		$content = '<'.'?php ';
		$content .= '$config = ' . var_export($data, true) . ';';
		return file_put_contents (BASE_DIR . '/' . $this->dir . '/' . md5 ( $key ) . '.php', $content );
	}
	
	public function has($key) {
		return is_file(BASE_DIR . '/' . $this->dir . '/' . md5 ( $key ) . '.php');
	}
	
	public function del($key) {
		if($this->has($key))
			return unlink(BASE_DIR . '/' . $this->dir . '/' . md5 ( $key ) . '.php');
		return false;
	}
	
	public function clear() {
		$d = dir ( $this->dir );
		while ( false !== ($entry = $d->read ()) ) {
			unlink (BASE_DIR . '/' . $this->dir. '/' . $entry . '.php' );
		}
		$d->close ();
	}
}