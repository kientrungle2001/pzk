<?php
class PzkAdminCourseProviderController extends PzkGridAdminController
{
  public const TABLE = TABLE_COURSE_PROVIDER;

  public $title     = 'Quản lý tổ chức';
  public $table     = self::TABLE;

  public $selectFields = [
    TABLE_COURSE_PROVIDER . DOT . F_ALL
  ];

  public function getListFieldSettings()
  {
    return [
      list_field(F_TITLE,     self::TABLE),
      list_field(F_CODE,      self::TABLE),
      list_field(F_ORDERING,  self::TABLE),
      list_field(F_STATUS,    self::TABLE)
    ];
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

  public $addLabel = 'Thêm tổ chức';
  public $addFields = [F_TITLE, F_CODE, F_IMG, F_CONTENT, F_STATUS];
  public function getAddFieldSettings()
  {
    return edit_fields([
      F_TITLE     . '[label=Tổ chức]',
      F_CODE      . '[label=Mã tổ chức]',
      F_IMG       . '[label=Ảnh tổ chức]',
      F_STATUS,
      F_CONTENT
    ], self::TABLE);
  }
}
