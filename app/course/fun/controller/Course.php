<?php
class PzkCourseController extends PzkController {
  public $masterPage = 'sidebar-left';
  public $masterPosition = 'right';
  public const COURSE_DETAIL_PAGE = 'course/detail';
  public function detailAction() {
    $detail = $this->parse(self::COURSE_DETAIL_PAGE);
    $detail->setItemId(pzk_request()->getSegment(3));
    $this->render($detail);
  }
}