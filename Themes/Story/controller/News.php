<?php
pzk_import_controller('Default', 'News');
class PzkNewsController extends PzkDefaultNewsController {
	public $masterPage 		= 'index';
	public $masterPosition 	= 'wrapper';
}