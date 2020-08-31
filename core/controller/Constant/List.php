<?php
define('LIST_TYPE_TEXT', 'text');
define('LIST_TYPE_DATETIME', 'datetime');
define('LIST_TYPE_STATUS', 'status');
define('LIST_TYPE_LINK', ATTR_LINK);
define('LIST_TYPE_PARENT', 'parent');
define('LIST_TYPE_ORDERING', 'ordering');
define('LIST_TYPE_NAMEID', 'nameid');
define('LIST_TYPE_IMAGE', 'image');
define('LIST_TYPE_VIDEO', 'video');

define('LIST_FIELD_CATEGORY_NAME', 'categoryName');
define('LIST_FIELD_CREATOR_NAME', 'creatorName');
define('LIST_FIELD_MODIFIED_NAME', 'modifiedName');
define('LIST_FIELD_CREATED', 'created');
define('LIST_FIELD_MODIFIED', 'modified');
define('LIST_FIELD_ORDERING', 'ordering');
define('LIST_FIELD_STATUS', 'status');
define('LIST_FIELD_CLASSES_WITH_FILTER', 'classesWithFilter');

class PzkListConstant
{

	public static $request = array(
		ATTR_INDEX => 'request',
		ATTR_TYPE => LIST_TYPE_TEXT,
		ATTR_LABEL => 'request'
	);
	public static $accountName = array(
		ATTR_INDEX => 'accountName',
		ATTR_TYPE => LIST_TYPE_TEXT,
		ATTR_LABEL => 'Tài khoản'
	);

	public static $accountType = array(
		ATTR_INDEX => 'accountType',
		ATTR_TYPE => LIST_TYPE_TEXT,
		ATTR_LABEL => 'Loại tài khoản'
	);

	public static $alias = array(
		ATTR_INDEX 		=> 'alias',
		ATTR_TYPE 			=> LIST_TYPE_TEXT,
		ATTR_LABEL 		=> 'Alias',
		ATTR_LINK			=> '/{data.row[alias]}?id='
	);

	public static $appName = array(
		ATTR_INDEX => 'appName',
		ATTR_TYPE => LIST_TYPE_TEXT,
		ATTR_LABEL => 'Ứng dụng'
	);

	public static $briefText = array(
		ATTR_INDEX 		=> 'brief',
		ATTR_TYPE 			=> LIST_TYPE_TEXT,
		ATTR_LABEL 		=> 'Mô tả',
		ATTR_IS_RAW			=> true
	);

	public static $campaignName = array(
		ATTR_INDEX 		=> 'campaignName',
		ATTR_TYPE 			=> LIST_TYPE_TEXT,
		ATTR_LABEL 		=> '<br />Chiến dịch'
	);
	public static $categoryIds = array(
		ATTR_INDEX 	=> 'categoryIds',
		ATTR_TYPE 		=> LIST_TYPE_NAMEID,
		ATTR_TABLE 	=> 'categories',
		ATTR_FIND_FIELD => 'id',
		ATTR_SHOW_FIELD => 'name',
		ATTR_LABEL 	=> 'Dạng bài tập',
	);
	public static $categoryName = array(
		ATTR_INDEX 		=> 'categoryName',
		ATTR_TYPE 			=> LIST_TYPE_TEXT,
		ATTR_LABEL 		=> '<br />Danh mục gốc'
	);


	public static $classes = array(
		ATTR_INDEX 		=> 'classes',
		ATTR_TYPE 			=> LIST_TYPE_TEXT,
		ATTR_LABEL 		=> 'Lớp'
	);

	public static $classesWithFilter = array(
		ATTR_INDEX 	=> 'classes',
		ATTR_TYPE 		=> LIST_TYPE_TEXT,
		ATTR_LABEL 	=> 'Lớp',
		'filter'	=> 	array(
			ATTR_INDEX 		=> 'classes',
			ATTR_TYPE 			=> 'selectoption',
			ATTR_LABEL 		=> 'Chọn lớp',
			'option' 		=> array(
				CLASS3 			=> "Lớp 3",
				CLASS4 			=> "Lớp 4",
				CLASS5 			=> "Lớp 5"
			),
			ATTR_LIKE 			=> true
		),
	);

	public static $click = array(
		ATTR_INDEX 		=> 'click',
		ATTR_TYPE 			=> LIST_TYPE_TEXT,
		ATTR_LABEL 		=> 'Số lượt click'
	);

	public static $comments = array(
		ATTR_INDEX 	=> 'comments',
		ATTR_TYPE 		=> LIST_TYPE_TEXT,
		ATTR_LABEL 	=> 'Lượt bình luận'
	);

	public static $comment = array(
		ATTR_INDEX 		=> 'comment',
		ATTR_TYPE 			=> LIST_TYPE_TEXT,
		ATTR_LABEL 		=> 'Bình luận'
	);

	public static $contentText = array(
		ATTR_INDEX 		=> 'content',
		ATTR_TYPE 			=> LIST_TYPE_TEXT,
		ATTR_LABEL 		=> 'Nội dung',
		ATTR_IS_RAW			=> true
	);

	public static $created = array(
		ATTR_INDEX 	=> 'created',
		ATTR_TYPE 		=> LIST_TYPE_DATETIME,
		ATTR_LABEL 	=> 'Ngày tạo',
		ATTR_FORMAT	=> 'H:i d/m'
	);

	public static $creatorName = array(
		ATTR_INDEX 	=> 'creatorName',
		ATTR_TYPE 		=> LIST_TYPE_TEXT,
		ATTR_LABEL 	=> 'Người tạo'
	);

	public static $display = array(
		ATTR_INDEX => 'display',
		ATTR_TYPE => LIST_TYPE_STATUS,
		ATTR_LABEL => 'Display',
		ATTR_ICON 			=> 'star'
	);

	public static $displayText = array(
		ATTR_INDEX 		=> 'display',
		ATTR_TYPE 			=> LIST_TYPE_TEXT,
		ATTR_LABEL 		=> 'Hiển thị',
		ATTR_MAPS	=> array(
			'0'				=> 'Có hiển thị',
			'1'				=> 'Không hiển thị'
		)
	);

	public static $endDate = array(
		ATTR_INDEX 		=> 'endDate',
		ATTR_TYPE 			=> LIST_TYPE_DATETIME,
		ATTR_LABEL 		=> 'Ngày kết thúc',
		ATTR_FORMAT		=> 'd/m'
	);

	public static $extotal = array(
		ATTR_INDEX 		=> 'extotal',
		ATTR_TYPE 			=> LIST_TYPE_TEXT,
		ATTR_LABEL 		=> 'Số bài tập'
	);
	public static $featured = array(
		ATTR_INDEX 		=> 'featured',
		ATTR_TYPE 			=> LIST_TYPE_STATUS,
		ATTR_LABEL 		=> '<br />Nổi bật'
	);
	public static $file = array(
		ATTR_INDEX 		=> 'file',
		ATTR_TYPE 			=> LIST_TYPE_TEXT,
		ATTR_LABEL 		=> 'File'
	);
	public static $global = array(
		ATTR_INDEX 		=> 'global',
		ATTR_TYPE 			=> LIST_TYPE_STATUS,
		ATTR_LABEL 		=> 'Toàn cục'
	);

	public static $group_question = array(
		ATTR_INDEX 		=> 'group_question',
		ATTR_TYPE 			=> LIST_TYPE_TEXT,
		ATTR_LABEL 		=> 'Dạng bài tập'
	);

	public static $gradeNum = array(
		ATTR_INDEX 		=> 'gradeNum',
		ATTR_TYPE 			=> LIST_TYPE_TEXT,
		ATTR_LABEL 		=> 'Khối'
	);

	public static $height = array(
		ATTR_INDEX 		=> 'height',
		ATTR_TYPE 			=> LIST_TYPE_TEXT,
		ATTR_LABEL 		=> 'Kích thước cao'
	);


	public static $img = array(
		ATTR_INDEX 		=> 'img',
		ATTR_TYPE 			=> LIST_TYPE_IMAGE,
		ATTR_LABEL 		=> '<br />Ảnh thumbnail'
	);

	public static $image = array(
		ATTR_INDEX 		=> 'image',
		ATTR_TYPE 			=> LIST_TYPE_IMAGE,
		ATTR_LABEL 		=> 'Ảnh'
	);

	public static $import = array(
		ATTR_INDEX 		=> "id",
		ATTR_TYPE 			=> LIST_TYPE_LINK,
		ATTR_LABEL 		=> 'Nhập dữ liệu',
		ATTR_LINK 			=> '/admin_category/importQuestions/'
	);

	public static $ip = array(
		ATTR_INDEX 		=> 'ip',
		ATTR_TYPE 			=> LIST_TYPE_TEXT,
		ATTR_LABEL 		=> 'Địa chỉ IP'
	);

	public static $isSort = array(
		ATTR_INDEX 		=> 'isSort',
		ATTR_TYPE 			=> LIST_TYPE_STATUS,
		ATTR_LABEL 		=> 'Sort',
		ATTR_ICON 			=> 'star'
	);

	public static $isSortText = array(
		ATTR_INDEX 		=> 'isSort',
		ATTR_TYPE 			=> LIST_TYPE_TEXT,
		ATTR_LABEL 		=> 'Sort',
		ATTR_MAPS			=> array(
			'0'				=> 'Đã kích hoạt',
			'1'				=> 'Chưa kích hoạt'
		)
	);

	public static $level = array(
		ATTR_INDEX => 'level',
		ATTR_TYPE => LIST_TYPE_TEXT,
		ATTR_LABEL => 'Tên quyền'
	);

	public static $likes = array(
		ATTR_INDEX 		=> 'likes',
		ATTR_TYPE 			=> LIST_TYPE_TEXT,
		ATTR_LABEL 		=> 'Lượt thích'
	);

	public static $mediaUrl = array(
		ATTR_INDEX => 'url',
		ATTR_TYPE => LIST_TYPE_VIDEO,
		ATTR_LABEL => 'Media'
	);

	public static $meta_description = array(
		ATTR_INDEX 		=> 'meta_description',
		ATTR_TYPE 			=> LIST_TYPE_TEXT,
		ATTR_LABEL 		=> 'Meta Description'
	);

	public static $meta_keywords = array(
		ATTR_INDEX 		=> 'meta_keywords',
		ATTR_TYPE 			=> LIST_TYPE_TEXT,
		ATTR_LABEL 		=> 'Meta Keywords'
	);

	public static  $modified = array(
		ATTR_INDEX 		=> 'modified',
		ATTR_TYPE 			=> LIST_TYPE_DATETIME,
		ATTR_LABEL 		=> 'Ngày sửa',
		ATTR_FORMAT		=> 'H:i d/m'
	);

	public static $modifiedName = array(
		ATTR_INDEX 		=> 'modifiedName',
		ATTR_TYPE 			=> LIST_TYPE_TEXT,
		ATTR_LABEL 		=> 'Người sửa'
	);

	public static $name = array(
		ATTR_INDEX 		=> 'name',
		ATTR_TYPE 			=> LIST_TYPE_TEXT,
		ATTR_LABEL 		=> 'Tên',
		ATTR_LINK			=> '/admin_{replace}/view/',
		ATTR_CTRL_LINK		=> '/admin_{replace}/edit/'
	);

	public static $name_en = array(
		ATTR_INDEX 		=> 'name_en',
		ATTR_TYPE 			=> LIST_TYPE_TEXT,
		ATTR_LABEL 		=> 'Tên tiếng anh',

	);

	public static $nameOfAreacode = array(
		ATTR_INDEX 		=> 'name',
		ATTR_TYPE 			=> LIST_TYPE_TEXT,
		ATTR_LABEL 		=> 'Tên địa điểm'
	);

	public static $nameOfAreatype = array(
		ATTR_INDEX 		=> 'name',
		ATTR_TYPE 			=> LIST_TYPE_PARENT,
		ATTR_LABEL 		=> 'Loại địa điểm'
	);

	public static $nameOfBackup = array(
		ATTR_INDEX => 'name',
		ATTR_TYPE => LIST_TYPE_TEXT,
		ATTR_LABEL => 'Backup'
	);

	public static $nameOfCate = array(
		ATTR_INDEX 		=> 'name',
		ATTR_TYPE 			=> LIST_TYPE_PARENT,
		ATTR_LABEL 		=> 'Tên',
		ATTR_LINK			=> '/admin_{replace}/view/',
		ATTR_CTRL_LINK		=> '/admin_{replace}/edit/'
	);

	public static $nameOfCategory = array(
		ATTR_INDEX 		=> 'name',
		ATTR_TYPE 			=> LIST_TYPE_TEXT,
		ATTR_LABEL 		=> 'Tên danh mục'
	);

	public static $vn_title = array(
		ATTR_INDEX 		=> 'vn_title',
		ATTR_TYPE 			=> LIST_TYPE_TEXT,
		ATTR_LABEL 		=> 'Danh mục tiếng Việt'
	);

	public static $en_title = array(
		ATTR_INDEX 		=> 'en_title',
		ATTR_TYPE 			=> LIST_TYPE_TEXT,
		ATTR_LABEL 		=> 'Danh mục tiếng Anh'
	);
	public static $document_en_title = array(
		ATTR_INDEX 		=> 'en_title',
		ATTR_TYPE 			=> LIST_TYPE_TEXT,
		ATTR_LABEL 		=> 'Tiêu đề tiếng Anh'
	);

	public static $nameOfNews = array(
		ATTR_INDEX 		=> 'name',
		ATTR_TYPE 			=> LIST_TYPE_TEXT,
		ATTR_LABEL 		=> 'Tin tức'
	);

	public static $nameOfCommon = array(
		ATTR_INDEX 		=> 'name',
		ATTR_TYPE 			=> LIST_TYPE_TEXT,
		ATTR_LABEL 		=> 'Tên',
		ATTR_LINK			=> '/admin_{replace}/view/',
		ATTR_CTRL_LINK		=> '/admin_{replace}/edit/'
	);



	public static $ordering = array(
		ATTR_INDEX 		=> 'ordering',
		ATTR_TYPE 			=> LIST_TYPE_ORDERING,
		ATTR_LABEL 		=> '<br />Thứ tự'
	);

	public static $orderingText = array(
		ATTR_INDEX 		=> 'ordering',
		ATTR_TYPE 			=> LIST_TYPE_TEXT,
		ATTR_LABEL 		=> 'Thứ tự'
	);

	public static $position = array(
		ATTR_INDEX 		=> 'position',
		ATTR_TYPE 			=> LIST_TYPE_TEXT,
		ATTR_LABEL 		=> 'Vị trí'
	);

	public static $published = array(
		ATTR_INDEX 		=> 'published',
		ATTR_TYPE 			=> LIST_TYPE_DATETIME,
		ATTR_FORMAT 		=> 'd/m/Y H:i',
		ATTR_LABEL 		=> 'Ngày gửi'
	);

	public static $question_type = array(
		ATTR_INDEX 		=> 'question_type',
		ATTR_TYPE 			=> LIST_TYPE_TEXT,
		ATTR_LABEL 		=> 'Code'
	);

	public static $question_types = array(
		ATTR_INDEX 		=> 'question_types',
		ATTR_TYPE 			=> LIST_TYPE_NAMEID,
		ATTR_TABLE 		=> 'questiontype',
		ATTR_SHOW_FIELD 	=> 'name',
		ATTR_FIND_FIELD 	=> 'id',
		ATTR_LABEL 		=> 'Loại câu hỏi'
	);

	public static $router = array(
		ATTR_INDEX 	=> 'router',
		ATTR_TYPE 		=> LIST_TYPE_TEXT,
		ATTR_LABEL 	=> 'Đường dẫn'
	);

	public static $showname = array(
		ATTR_INDEX 		=> 'showname',
		ATTR_TYPE 			=> LIST_TYPE_STATUS,
		ATTR_LABEL 		=> 'Hiển thị tiêu đề'
	);

	public static $startDate = array(
		ATTR_INDEX 		=> 'startDate',
		ATTR_TYPE 			=> LIST_TYPE_DATETIME,
		ATTR_LABEL 		=> 'Ngày bắt đầu',
		ATTR_FORMAT		=> 'd/m'
	);

	public static $sharedSoftwares = array(
		ATTR_INDEX 		=> 'sharedSoftwares',
		ATTR_TYPE 			=> LIST_TYPE_TEXT,
		ATTR_LABEL 		=> 'Chia sẻ'
	);

	public static $software = array(
		ATTR_INDEX 		=> 'software',
		ATTR_TYPE 			=> LIST_TYPE_TEXT,
		ATTR_LABEL 		=> 'Phần mềm'
	);


	public static $status = array(
		ATTR_INDEX 		=> 'status',
		ATTR_TYPE 			=> LIST_TYPE_STATUS,
		ATTR_LABEL 		=> '<br />Trạng thái'
	);

	public static $statusText = array(
		ATTR_INDEX 		=> 'status',
		ATTR_TYPE 			=> LIST_TYPE_TEXT,
		ATTR_LABEL 		=> 'Trạng thái',
		ATTR_MAPS			=> array(
			'0'	=> 'Đã kích hoạt',
			'1'	=> 'Chưa kích hoạt'
		)
	);

	public static $title = array(
		ATTR_INDEX 		=> 'title',
		ATTR_TYPE 			=> LIST_TYPE_TEXT,
		ATTR_LABEL 		=> 'Tieu de',
		ATTR_LINK			=> '/admin_{replace}/view/',
		ATTR_CTRL_LINK		=> '/admin_{replace}/edit/'
	);

	public static $trial = array(
		ATTR_INDEX 		=> 'trial',
		ATTR_TYPE 			=> LIST_TYPE_STATUS,
		ATTR_LABEL 		=> 'Dùng thử',
		ATTR_LINK			=> '/admin_{replace}/view/',
		ATTR_CTRL_LINK		=> '/admin_{replace}/edit/'
	);

	public static $type = array(
		ATTR_INDEX 		=> ATTR_TYPE,
		ATTR_TYPE 			=> LIST_TYPE_TEXT,
		ATTR_LABEL 		=> 'Loại'
	);

	public static $typeOfApp = array(
		ATTR_INDEX 		=> ATTR_TYPE,
		ATTR_TYPE 			=> LIST_TYPE_TEXT,
		ATTR_LABEL 		=> 'Loại ứng dụng'
	);

	public static $typeOfAreacode = array(
		ATTR_INDEX 		=> ATTR_TYPE,
		ATTR_TYPE 			=> LIST_TYPE_TEXT,
		ATTR_LABEL 		=> 'Loại địa điểm'
	);

	public static $username = array(
		ATTR_INDEX 		=> 'username',
		ATTR_TYPE 			=> LIST_TYPE_TEXT,
		ATTR_LABEL 		=> 'Tên đăng nhập',
		ATTR_LINK			=> '/admin_{replace}/view/{data.row[userId]}/',
		ATTR_CTRL_LINK		=> '/admin_{replace}/edit/{data.row[userId]}/'
	);

	public static $url = array(
		ATTR_INDEX 		=> 'url',
		ATTR_TYPE 			=> LIST_TYPE_TEXT,
		ATTR_LABEL 		=> 'Liên kết đích'
	);

	public static $urlOfBackup = array(
		ATTR_INDEX 		=> 'url',
		ATTR_TYPE 			=> LIST_TYPE_LINK,
		ATTR_LABEL 		=> 'Download',
		ATTR_LINK			=> '/admin_backup/download/'
	);

	public static $views = array(
		ATTR_INDEX 		=> 'views',
		ATTR_TYPE 			=> LIST_TYPE_TEXT,
		ATTR_LABEL 		=> 'Lượt Xem'
	);

	public static $videoUrl = array(
		ATTR_INDEX => 'url',
		ATTR_TYPE => LIST_TYPE_VIDEO,
		ATTR_LABEL => 'Video'
	);

	public static $visited = array(
		ATTR_INDEX	=> 'visited',
		ATTR_LABEL	=> 'Thời gian ghé thăm',
		ATTR_TYPE	=> LIST_TYPE_DATETIME,
		ATTR_FORMAT	=> 'd/m/Y H:i:s'
	);

	public static $width = array(
		ATTR_INDEX => 'width',
		ATTR_TYPE => LIST_TYPE_TEXT,
		ATTR_LABEL => 'Kích thước dài'
	);

	public static $yearNum = array(
		ATTR_INDEX => 'yearNum',
		ATTR_TYPE => LIST_TYPE_TEXT,
		ATTR_LABEL => 'Niên khóa'
	);

	public static $groupIndex = 0;
	public static function group($label, $fields, $replace)
	{
		self::$groupIndex++;
		$result  =
			array(
				ATTR_INDEX			=> 'none' . self::$groupIndex,
				ATTR_TYPE			=> 'group',
				ATTR_LABEL			=> $label,
				ATTR_DELIMITER		=> '<br />',
				ATTR_FIELDS			=> []
			);
		if (is_string($fields))
			$fields = explodetrim(',', $fields);
		foreach ($fields as $field) {
			if ($field)
				$result[ATTR_FIELDS][] = self::get($field, $replace);
		}
		return $result;
	}

	public static function  get($field, $replace)
	{
		$dom = pzk_parse_selector($field);
		$tagName = $dom['tagName'];
		if (isset(self::$$tagName)) {
			$result = self::$$tagName;
		} else {
			$result = array(
				ATTR_INDEX	=> 	$tagName,
				ATTR_LABEL	=> 	$tagName,
				ATTR_TYPE	=>	LIST_TYPE_TEXT
			);
		}
		foreach ($dom['attrs'] as $attr) {
			$result[$attr['name']] = $attr['value'];
		}
		foreach ($result as $key => $val) {
			if (is_string($val))
				$result[$key] = str_replace('{replace}', $replace, $val);
		}
		return $result;
	}

	public static function  gets($fields, $replace)
	{
		if (is_string($fields))
			$fields = explodetrim(',', $fields);
		$result = array();
		foreach ($fields as $field) {
			$result[] = self::get($field, $replace);
		}
		return $result;
	}
}

class PzkGridConstant
{

	public static $comments = array(
		ATTR_INDEX			=> 'comments',
		'title'			=> 'Bình luận',
		ATTR_LABEL			=> 'Bình luận',
		ATTR_TABLE			=> '{replace}_comment',
		'parentField'	=> '{replace}Id',
		'addLabel'		=> 'Thêm bình luận',
		'quickMode'		=> false,
		'module'		=> '{replace}_comment',
	);

	public static $visitors = array(
		ATTR_INDEX			=> 'visitors',
		'title'			=> 'Người ghé thăm',
		ATTR_LABEL			=> 'Người ghé thăm',
		ATTR_TABLE			=> '{replace}_visitor',
		'addLabel'		=> 'Thêm người ghé thăm',
		'quickMode'		=> false,
		'module'		=> 'visitor',
		'parentField'	=> '{replace}Id',
	);

	public static $social_schedules = array(
		ATTR_INDEX			=> 'social_schedules',
		'title'			=> 'Lịch đăng facebook',
		ATTR_LABEL			=> 'Lịch đăng facebook',
		ATTR_TABLE			=> 'social_schedule',
		'addLabel'		=> 'Thêm lịch đăng',
		'quickMode'		=> false,
		'module'		=> 'socialschedule',
		'parentField'	=> '{replace}Id',
		ATTR_FIELDS 		=> 'social_schedule.*, {replace}.title as name, social_app.name as appName,
		social_app.type as type, social_account.name as accountName, social_account.type as accountType',
		'filterStatus' 	=> true,
		'orderBy'		=> 'social_schedule.id desc',
		'searchFields' 	=> array('name'),
		'searchLabel' 	=> 'Tên ứng dụng',
	);

	public static function  get($field, $replace, $params = array())
	{
		$dom = pzk_parse_selector($field);
		$tagName = $dom['tagName'];
		$result = self::$$tagName;
		foreach ($dom['attrs'] as $attr) {
			$result[$attr['name']] = $attr['value'];
		}
		foreach ($result as $key => $val) {
			if (is_string($val))
				$result[$key] = str_replace('{replace}', $replace, $val);
		}
		foreach ($params as $key => $val) {
			$result[$key] = $val;
		}
		return $result;
	}
}

function list_fields($fields, $replace)
{
	return PzkListConstant::gets($fields, $replace);
}

function list_field($field, $replace)
{
	return PzkListConstant::get($field, $replace);
}

function list_fields_group($label, $fields, $replace)
{
	return PzkListConstant::group($label, $fields, $replace);
}
