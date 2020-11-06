<?php
class PzkCourseController extends PzkController
{
  public $masterPage = 'sidebar-left';
  public $masterPosition = 'right';
  public const COURSE_DETAIL_PAGE = 'course/detail';
  public const COURSE_LIST_PAGE = 'course/list';
  public const COURSE_SECTION_PAGE = 'course/section';
  public const COURSE_SECTION_LIST_PAGE = 'course/section/list';
  public function detailAction()
  {
    $detail = $this->parse(self::COURSE_DETAIL_PAGE);
    $detail->setItemId(pzk_request()->getSegment(3));
    $this->render($detail);
  }

  public function listAction()
  {
    $list = $this->parse(self::COURSE_LIST_PAGE);
    $list->setParentId(pzk_request()->getSegment(3));
    $this->render($list);
  }

  public function sectionAction($courseId, $sectionId)
  {
    $detail = $this->parse(self::COURSE_SECTION_PAGE);
    $detail->setItemId($courseId);
    $section = pzk_element()->getSection();
    $section->setCourseId($courseId);
    $section->setItemId($sectionId);

    $sectionList = $this->parse(self::COURSE_SECTION_LIST_PAGE);
    $sectionList->setParentId($courseId);
    $this->initPage();
    $this->append($detail);
    $this->append($sectionList, 'left');
    $this->display();
  }
}
