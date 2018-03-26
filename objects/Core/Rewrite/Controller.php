<?php
pzk_import('Core.Rewrite.Request');
class PzkCoreRewriteController extends PzkCoreRewriteRequest {
	public $pattern = "^\/([*controller*][\w_][\w\d_]*)\/([*action*][\w_][\w\d_]*)";
	public $queryParams = "controller, action";
}