<?php
class PzkFormController extends PzkController {
	public function validate($rq) {
		$valid = true;
		foreach(_pzk('element.login')->children as $elem) {
			if (!$elem->validate(isset($rq[$elem->name])?$rq[$elem->name]: null)) $valid = false;
		}
		return $valid;
	}
}
?>