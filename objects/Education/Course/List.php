<?php
pzk_import('Core.Db.List');

class PzkEducationCourseList extends PzkCoreDbList
{
  public $table         =   "course";
  public $orderBy       =   "ordering asc";
  public $parentMode    =   "true";
  public $parentField   =   "categoryId";
  public $layout        =   "course/list";
}
