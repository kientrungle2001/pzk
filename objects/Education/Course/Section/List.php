<?php
pzk_import('Core.Db.List');

class PzkEducationCourseSectionList extends PzkCoreDbList
{
  public $table         =   "course_section";
  public $parentMode    =   "true";
  public $parentField   =   "courseId";
  public $orderBy       =   "ordering asc";
  public $layout        =   "course/section/list";
}
