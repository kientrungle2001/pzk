<?php
class PzkEducationPracticeSlider extends PzkObject {
	public function getSlider($name){
		$data = _db()->selectId()->fromSlideshow()->whereName($name)->result_one();
		$slideShowImageId = $data['id'];
		$image = _db()->selectId()->fromSlideshow_images()->whereSlideshowId($slideShowImageId)->whereStatus(1)->orderBy('ordering asc')->result();
		return $image;
	}
}
?>