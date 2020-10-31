<?php
class PzkCourseController extends PzkController {
  public $masterPage = 'sidebar-left';
  public $masterPosition = 'right';
  public const COURSE_DETAIL_PAGE = 'course/detail';
  public function detailAction() {
    $this->render(self::COURSE_DETAIL_PAGE);
  }
}