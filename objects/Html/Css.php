<?php
class PzkHtmlCss extends PzkObject {
	public $boundable = false;
	public $layout = 'html/css';
	public $group = 'common';
	public $src = '';
	public $cacheable	=	'true';
	public $cacheParams	=	'layout,src';
	public function display() {
		echo '<link type="text/css" property="stylesheet" rel="stylesheet" href="'.$this->src.'" />';
	}
}