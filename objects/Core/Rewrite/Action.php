<?php
pzk_import('Core.Rewrite.Request');
class PzkCoreRewriteAction extends PzkCoreRewriteRequest {
	public $pattern="^\/([*controller*][\w_][\w\d_]*)[\/]?$";
	public $queryParams = "controller";
	public $defaultQueryParams= array('action'	=> 'index');
}