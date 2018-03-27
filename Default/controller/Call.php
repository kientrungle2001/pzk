<?php
class PzkCallController {
	public function serviceAction($model, $service, $param1, $param2, $param3, $param4, $param5) {
		$modelObj = pzk_model($model);
		$data = $modelObj->$service($param1, $param2, $param3, $param4, $param5);
		echo json_encode($data);
	}
}