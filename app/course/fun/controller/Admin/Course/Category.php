<?php
class PzkAdminCourseCategoryController extends PzkGridAdminController
{
  public const TABLE = 'course_category';

  public $title     = 'Quản lý danh mục';
  public $table     = self::TABLE;
  public $mdAddOffset  = '1';
  public $mdAddSize  = '10';

  public $selectFields = [
    'course_category.*'
  ];

  public function getListFieldSettings()
  {
    return array(
      list_field(F_TITLE, self::TABLE),
      list_field(F_CODE, self::TABLE),
      list_field(F_STATUS, self::TABLE)
    );
  }

  public $searchLabel = 'Tìm kiếm';
  public $searchFields = [
    [C_COLUMN, self::TABLE, F_ID],
    [C_COLUMN, self::TABLE, F_TITLE],
    [C_COLUMN, self::TABLE, F_CODE]
  ];

  public function getFilterFields()
  {
    return filter_fields([F_STATUS], self::TABLE);
  }

  public function getSortFields()
  {
    return sort_fields([F_ID, F_TITLE, F_CODE], self::TABLE);
  }

  public $quickMode = false;
  public function getQuickFieldSettings()
  {
    return list_fields(F_TITLE, self::TABLE);
  }

  public $logable = true;
  public $logFields = [F_TITLE, F_CODE, F_CONTENT];

  public $addLabel = 'Thêm danh mục';
  public $addFields = [F_TITLE, F_CODE, F_CONTENT, F_STATUS];
  public function getAddFieldSettings()
  {
    return edit_fields([
      F_TITLE . '[mdsize=4]',
      F_CODE . '[mdsize=4]',
      F_STATUS . '[mdsize=4]',
      F_CONTENT
    ], self::TABLE);
  }
}
