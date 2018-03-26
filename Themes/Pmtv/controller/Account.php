<?php
pzk_import_controller('Default', 'Account');
class PzkAccountController extends PzkDefaultAccountController {
	public $masterPosition = 'left';
	public $subMasterPage  = 'home/sub';
	public $subMasterPosition = 'content';
}