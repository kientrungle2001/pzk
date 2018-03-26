<?php
if(!class_exists('PzkHtmlJs')) {
	class PzkHtmlJs extends PzkObject {
		public $boundable = false;
		public $layout = 'html/js';
		public $group = 'common';
		public $src = '';
		public $cacheable	=	'true';
		public $cacheParams	=	'layout,src';
		
		public function display() {
			echo '<script type="text/javascript" src="'.$this->src.'"></script>';
		}
	}
}