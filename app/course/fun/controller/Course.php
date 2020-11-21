<?php
class PzkCourseController extends PzkController
{
  public const COURSE_DETAIL_PAGE       = 'course/detail';
  public const COURSE_LIST_PAGE         = 'course/list';
  public const COURSE_SECTION_PAGE      = 'course/section';
  public const COURSE_SECTION_LIST_PAGE = 'course/section/list';

  public const LEFT_POSITION = 'left';
  public const RIGHT_POSITION = 'right';
  public const MASTER_PAGE = 'sidebar-left';
  
  public $masterPage = self::MASTER_PAGE;
  public $masterPosition = self::RIGHT_POSITION;

  public function detailAction($courseId)
  {
    /**
     * @var PzkCoreDbDetail $detail
     */
    $detail = $this->parse(self::COURSE_DETAIL_PAGE);
    $detail->setItemId($courseId);
    $this->render($detail);
  }

  public function listAction($courseId)
  {
    $this->initPage();
    $list = $this->parse(self::COURSE_LIST_PAGE);
    $list->setParentId($courseId);
    $courseMenu = pzk_element()->getCourseMenu();
    if($courseMenu) {
      $courseMenu->setActiveCourseId($courseId);
    }
    $this->append($list);
    $this->display();
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
    $this->append($sectionList, self::LEFT_POSITION);
    $this->display();
  }
}
