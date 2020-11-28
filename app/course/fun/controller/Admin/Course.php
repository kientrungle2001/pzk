<?php
class PzkAdminCourseController extends PzkGridAdminController
{
  public const TABLE = 'course';

  public $title     = 'Quản lý khóa hoc';
  public $table     = self::TABLE;
  public $mdAddOffset  = '2';
  public $mdAddSize  = '8';

  public $selectFields = [
    'course.*',
    'categories.name as categoryName'
  ];

  public function getJoins() {
    return join_tables([JOIN_TABLE_CATEGORY], self::TABLE);
  }

  public function getListFieldSettings()
  {
    return array(
      list_field(F_TITLE, self::TABLE),
      list_field(F_CATEGORY_NAME . '[label=Danh mục]', self::TABLE),
      list_field(F_CODE, self::TABLE),
      list_field(F_ORDERING, self::TABLE),
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
    return sort_fields([F_ID, F_TITLE, F_CODE, F_CATEGORY_ID. '[label=Danh mục]'], self::TABLE);
  }

  public $quickMode = false;
  public function getQuickFieldSettings()
  {
    return list_fields(F_TITLE, self::TABLE);
  }

  public $logable = true;
  public $logFields = [F_TITLE, F_CODE, F_CONTENT];

  public $addLabel = 'Thêm khóa học';
  public $addFields = [F_TITLE, F_CATEGORY_ID, F_CODE, F_IMG, F_CONTENT, F_STATUS];
  public function getAddFieldSettings()
  {
    return edit_fields([
      F_TITLE . '[label=Khóa học]',
      F_CODE . '[label=Mã khóa học]',
      F_IMG . '[label=Ảnh khóa học]',
      F_CATEGORY_ID . '[label=Danh mục]',
      F_STATUS,
      F_CONTENT
    ], self::TABLE);
  }
}
