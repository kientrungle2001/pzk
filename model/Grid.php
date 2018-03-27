<?php
class PzkGridModel {
	public function listing($table, $pageSize, $pageNum, $conditions) {
		$conditions = urldecode($conditions);
		$items = _db()->selectAll()->from($table)->limit($pageSize, $pageNum)->where($conditions)->result();
		$itemsCount = _db()->select('count(*) as c')->from($table)->where($conditions)->result_one();
		return array(
			'items'			=> 	$items,
			'totalItems'	=>	$itemsCount['c']
		);
	}
}