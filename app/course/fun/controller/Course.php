<?php
class PzkCourseController extends PzkController {
  public $masterPage = 'sidebar-left';
  public $masterPosition = 'right';
  public const COURSE_DETAIL_PAGE = 'course/detail';
  public const COURSE_LIST_PAGE = 'course/list';
  public function detailAction() {
    $detail = $this->parse(self::COURSE_DETAIL_PAGE);
    $detail->setItemId(pzk_request()->getSegment(3));
    $this->render($detail);
  }

  public function listAction() {
    $list = $this->parse(self::COURSE_LIST_PAGE);
    $list->setParentId(pzk_request()->getSegment(3));
    $this->render($list);
  }
}