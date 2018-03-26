<?php
pzk_import('Core.Db.List');
class PzkCmsDocumentList extends PzkCoreDbList {
	public $layout = 'cms/document/list';
	public $table = 'document';
	public $cacheable = true;
	public $cacheParams = 'layout,parentId,selectedItemId';
	public $conditions='["and",["status", "1"], ["type", "document"]]';
}