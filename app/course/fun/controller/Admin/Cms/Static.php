<?php
class PzkAdminCmsStaticController extends PzkGridAdminController
{
  public const TABLE = 'cms_static';

  public $title     = 'Quản lý khối tĩnh';
  public $table     = self::TABLE;
  public $mdAddOffset  = '2';
  public $mdAddSize  = '8';

  public $selectFields = [
    'cms_static.*'
  ];

  public function getListFieldSettings()
  {
    return array(
      list_field(F_TITLE, self::TABLE),
      list_field(F_CODE . '[label=Mã]', self::TABLE),
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

  public $addLabel = 'Thêm khối tĩnh';
  public $addFields = [F_TITLE, F_CODE, F_CONTENT, F_STATUS];
  public function getAddFieldSettings()
  {
    return edit_fields([
      F_TITLE . '[label=Tiêu đề][inline=true]',
      F_CODE . '[label=Mã][inline=true]',
      F_STATUS . '[inline=true]',
      F_CONTENT
    ], self::TABLE);
  }
}
