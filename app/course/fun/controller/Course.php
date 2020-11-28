<?php
class PzkCourseController extends PzkController
{
  public const COURSE_ENROLL_PAGE       = 'course/enroll';
  public const COURSE_DETAIL_PAGE       = 'course/detail';
  public const COURSE_LIST_PAGE         = 'course/list';
  public const COURSE_SECTION_PAGE      = 'course/section';
  public const COURSE_SECTION_LIST_PAGE = 'course/section/list';

  public const LEFT_POSITION            = 'left';
  public const RIGHT_POSITION           = 'right';
  public const MASTER_PAGE              = 'sidebar-left';
  
  public $masterPage                    = self::MASTER_PAGE;
  public $masterPosition                = self::RIGHT_POSITION;

  public function detailAction($courseId)
  {
    /**
     * @var PzkCoreDbDetail $detail
     */
    $detail = $this->parse(self::COURSE_DETAIL_PAGE);
    $detail->setItemId(intval($courseId));
    $this->render($detail);
  }

  public function listAction($courseId)
  {
    $this->initPage();
    /**
     * @var PzkCoreDbList $list
     */
    $list = $this->parse(self::COURSE_LIST_PAGE);
    $list->setParentId(intval($courseId));
    $courseMenu = pzk_element()->getCourseMenu();
    if($courseMenu) {
      $courseMenu->setActiveCourseId(intval($courseId));
    }
    $this->append($list);
    $this->display();
  }

  public function sectionAction($courseId, $sectionId)
  {
    $detail = $this->parse(self::COURSE_SECTION_PAGE);
    $detail->setItemId(intval($courseId));
    $section = pzk_element()->getSection();
    $section->setCourseId(intval($courseId));
    $section->setItemId(intval($sectionId));

    $sectionList = $this->parse(self::COURSE_SECTION_LIST_PAGE);
    $sectionList->setParentId(intval($courseId));
    $this->initPage();
    $this->append($detail);
    $this->append($sectionList, self::LEFT_POSITION);
    $this->display();
  }

  public function enrollAction($courseId) {
    /**
     * @var PzkCoreDbDetail $detail
     */
    $detail = $this->parse(self::COURSE_ENROLL_PAGE);
    $detail->setItemId(intval($courseId));
    $this->render($detail);    
  }
}
