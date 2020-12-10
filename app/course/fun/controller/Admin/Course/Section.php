<?php
class PzkAdminCourseSectionController extends PzkGridAdminController
{
  public const TABLE = 'course_section';

  public $title     = 'Quản lý bài học';
  public $table     = self::TABLE;

  public $selectFields = [
    'course_section.*',
    'course.title as courseTitle'
  ];

  public function getJoins() {
    return join_tables([JOIN_TABLE_COURSE], self::TABLE);
  }

  public function getListFieldSettings()
  {
    return array(
      list_field(F_TITLE . '[label=Bài học]', self::TABLE),
      list_field(F_COURSE_TITLE . '[label=Khóa học]', self::TABLE),
      list_field(F_CODE . '[label=Mã]', self::TABLE),
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
    return filter_fields([F_COURSE_ID, F_STATUS], self::TABLE);
  }

  public function getSortFields()
  {
    return sort_fields([F_ID, F_TITLE, F_CODE, F_COURSE_ID. '[label=Danh mục]'], self::TABLE);
  }

  public $quickMode = false;
  public function getQuickFieldSettings()
  {
    return list_fields(F_TITLE, self::TABLE);
  }

  public $logable = true;
  public $logFields = [F_TITLE, F_CODE, F_COURSE_ID, F_CONTENT];

  public $addLabel = 'Thêm bài học';
  public $addFields = [F_TITLE, F_COURSE_ID, F_CODE, F_CONTENT, F_STATUS];
  public function getAddFieldSettings()
  {
    return edit_fields([
      F_TITLE . '[label=Bài học]',
      F_CODE . '[label=Mã bài học]',
      F_COURSE_ID,
      F_STATUS,
      F_CONTENT
    ], self::TABLE);
  }
}
