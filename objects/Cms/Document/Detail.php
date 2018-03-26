<?php
pzk_import('Cms.Detail');
class PzkCmsDocumentDetail extends PzkCmsDetail {
	public $layout = 'education/document/detail';
	public $table = 'document';
	public $cacheable = true;
	public $conditions='["status", "1"]';
	
	public function checkIsGameByType($gamecode, $documentId){
		$data = _db()->select('count(*) as c')
            ->from('game')
            ->where("gamecode = '$gamecode'")
			->where("documentId = $documentId");
			$rows = $data->result_one();
		if($rows['c'] > 0){
			return true;
		}else{
			return false;
		}
	}
}