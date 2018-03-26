<?php
class PzkSGStoreLazy extends PzkSGStore {
	public $session = null;
	public $isChanged = false;
	public function set($key, $value) {
		if(null === $this->session)
			$this->loadSession();
		if(!isset($this->session[$key]) || ($value !== $this->session[$key])) {
			$this->session[$key] = $value;
			$this->isChanged = true;
		}
	}
	
	public function saveSession() {
		if($this->isChanged) {
			$this->storage->set('session', $this->session);
		}
	}
	
	public function loadSession() {
		if(!$this->session) {
			$this->session = $this->storage->get('session');
			if(!$this->session) {
				$this->session = array();
			}
		}
		return $this->session;
	}
	
	public function get($key, $timeout = null) {
		if(null === $this->session)
			$this->loadSession();
		if(isset($this->session[$key])) return $this->session[$key];
		return null;
	}
	public function del($key) {
		if(null === $this->session)
			$this->loadSession();
		if(isset($this->session[$key])) {
			unset($this->session[$key]);
			$this->isChanged = true;
		}
	}
}