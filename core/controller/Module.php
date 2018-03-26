<?php
class PzkModuleController extends PzkController {
	public function getModules($alias) {
		$modules = _db()->select('*')->from('module')
			->likeAlias('%'.$alias.'%')
			->orderBy('ordering asc')
			->whereStatus(1)
			->result();
		return $modules;
	}
	
	public function loadModules($alias) {
		$modules = $this->getModules($alias);
		foreach($modules as $module) {
			$region = pzk_element($module['position']);
			if($region) {
				$region->append($this->parse($module['content']));
			}
		}
	}
	
	public function displayModules($modules) {
		foreach($modules as $module) {
			$region = pzk_element($module['position']);
			if($region) {
				$region->append($this->parse($module['content']));
			}
		}
	}
	
	public function getAllModules() {
		$modules = _db()->select('*')->from('module')
			->orderBy('ordering asc')
			->whereStatus(1)
			->result();
		return $modules;
	}
	
	public function jQuery($selector) {
		return new PzkJQuery($selector);
	}
}

class PzkJQuery {
	public $selector;
	public $commands = array();
	public function __construct($selector) {
		$this->selector = $selector;
	}
	
	public function execute(){
		echo 'jQuery(' , json_encode($this->selector) , ')';
		foreach($this->commands as $command) {
			echo '.', $command['name'] , '(';
			$args = array();
			foreach($command['arguments'] as $arg){
				$args[] = json_encode($arg);
			}
			echo implode(',', $args);
			echo ')';
		}
		echo ';';
	}
	
	public function __call($name, $arguments) {
		$this->commands[] = array('name' => $name, 'arguments' => $arguments);
		return $this;
	}
}