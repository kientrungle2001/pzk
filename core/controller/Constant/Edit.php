<?php
define('EDIT_TYPE_DATEPICKER', 			'datepicker');
define('EDIT_TYPE_DATETIMEPICKER', 		'datetimepicker');
define('EDIT_TYPE_FILE_MANAGER', 		'filemanager');
define('EDIT_TYPE_MULTISELECT', 		'multiselect');
define('EDIT_TYPE_MULTISELECTOPTION', 	'multiselectoption');
define('EDIT_TYPE_SELECT', 				'select');
define('EDIT_TYPE_STATUS', 				'status');
define('EDIT_TYPE_TEXT', 				'text');
define('EDIT_TYPE_PASSWORD', 				'password');
define('EDIT_TYPE_TEXT_AREA',			'textarea');
define('EDIT_TYPE_TINYMCE', 			'tinymce');
define('EDIT_TYPE_UPLOAD', 				'upload');
define('EDIT_TYPE_UPLOAD_TYPE_IMAGE', 	'image');
define('EDIT_TYPE_UPLOAD_TYPE_VIDEO', 	'video');
define('EDIT_TYPE_UPLOAD_TYPE_AUDIO', 	'audio');

class PzkEditConstant
{
	public static $name = array(
		ATTR_INDEX 		=> 'name',
		ATTR_TYPE 			=> EDIT_TYPE_TEXT,
		ATTR_LABEL 		=> 'Tên'
	);

	public static $nameOfAreatype = array(
		ATTR_INDEX 		=> 'name',
		ATTR_TYPE 			=> EDIT_TYPE_TEXT,
		ATTR_LABEL 		=> 'Tên loại địa điểm',
	);

	public static $nameOfCategory = array(
		ATTR_INDEX 		=> 'name',
		ATTR_TYPE 			=> EDIT_TYPE_TEXT,
		ATTR_LABEL 		=> 'Tên danh mục'
	);

	public static $vn_title = array(
		ATTR_INDEX 		=> 'vn_title',
		ATTR_TYPE 			=> EDIT_TYPE_TEXT,
		ATTR_LABEL 		=> 'Tên danh mục tiếng Việt'
	);

	public static $en_title = array(
		ATTR_INDEX 		=> 'en_title',
		ATTR_TYPE 			=> EDIT_TYPE_TEXT,
		ATTR_LABEL 		=> 'Tên danh mục tiếng Anh'
	);

	public static $title = array(
		ATTR_INDEX 		=> 'title',
		ATTR_TYPE 			=> EDIT_TYPE_TEXT,
		ATTR_LABEL 		=> 'Tên tin tức',
	);
	public static $img = array(
		ATTR_INDEX 		=> 'img',
		ATTR_TYPE 			=> EDIT_TYPE_UPLOAD,
		ATTR_UPLOADTYPE	=> EDIT_TYPE_UPLOAD_TYPE_IMAGE,
		ATTR_LABEL 		=> 'Ảnh minh họa ',
	);
	public static $image = array(
		ATTR_INDEX 		=> 'image',
		ATTR_TYPE 			=> EDIT_TYPE_FILE_MANAGER,
		ATTR_UPLOADTYPE	=> EDIT_TYPE_UPLOAD_TYPE_IMAGE,
		ATTR_LABEL 		=> 'Ảnh',
	);
	public static $file = array(
		ATTR_INDEX 		=> 'file',
		ATTR_TYPE 			=> EDIT_TYPE_FILE_MANAGER,
		ATTR_UPLOADTYPE	=> EDIT_TYPE_UPLOAD_TYPE_IMAGE,
		ATTR_LABEL 		=> 'Chọn File',
	);
	public static $brief = array(
		ATTR_INDEX 		=> 'brief',
		ATTR_TYPE 			=> EDIT_TYPE_TEXT_AREA,
		ATTR_LABEL 		=> 'Mô tả'
	);
	public static $content =  array(
		ATTR_INDEX 		=> 'content',
		ATTR_TYPE 			=> EDIT_TYPE_TINYMCE,
		ATTR_LABEL 		=> 'Nội dung'
	);
	public static $alias =  array(
		ATTR_INDEX 		=> 'alias',
		ATTR_TYPE 			=> EDIT_TYPE_TEXT,
		ATTR_LABEL 		=> 'Alias'
	);
	public static $ordering = array(
		ATTR_INDEX 		=> 'ordering',
		ATTR_TYPE 			=> EDIT_TYPE_TEXT,
		ATTR_LABEL 		=> 'Thứ tự sắp xếp'
	);
	public static $startDate =  array(
		ATTR_INDEX 		=> 'startDate',
		ATTR_TYPE 			=> EDIT_TYPE_DATEPICKER,
		ATTR_LABEL 		=> 'Ngày bắt đầu'
	);
	public static $endDate = array(
		ATTR_INDEX 		=> 'endDate',
		ATTR_TYPE 			=> EDIT_TYPE_DATEPICKER,
		ATTR_LABEL 		=> 'Ngày kết thúc'
	);
	public static $extotal = array(
		ATTR_INDEX 		=> 'extotal',
		ATTR_TYPE 			=> EDIT_TYPE_TEXT,
		ATTR_LABEL 		=> 'Số lượng bài tập'
	);
	public static $courseId = array(
		ATTR_INDEX 		=> 'courseId',
		ATTR_TYPE 			=> EDIT_TYPE_SELECT,
		ATTR_LABEL 		=> 'Khóa học',
		ATTR_TABLE 		=> 'course',
		ATTR_SHOW_VALUE 	=> 'id',
		ATTR_SHOW_NAME 	=> 'title'
	);
	public static $categoryId = array(
		ATTR_INDEX 		=> 'categoryId',
		ATTR_TYPE 			=> EDIT_TYPE_SELECT,
		ATTR_LABEL 		=> 'Danh mục cha',
		ATTR_TABLE 		=> 'categories',
		ATTR_SHOW_VALUE 	=> 'id',
		ATTR_SHOW_NAME 	=> 'name'
	);
	public static $categoryIds = array(
		ATTR_INDEX 		=> 'categoryIds',
		ATTR_TYPE 			=> EDIT_TYPE_MULTISELECT,
		ATTR_LABEL 		=> 'Danh mục cha',
		ATTR_TABLE 		=> 'categories',
		ATTR_SHOW_VALUE 	=> 'id',
		ATTR_SHOW_NAME 	=> 'name'
	);
	public static $newsCategoryId = array(
		ATTR_INDEX 		=> 'categoryId',
		ATTR_TYPE 			=> EDIT_TYPE_SELECT,
		ATTR_LABEL 		=> 'Danh mục cha',
		ATTR_TABLE 		=> 'categories',
		ATTR_SHOW_VALUE 	=> 'id',
		ATTR_SHOW_NAME 	=> 'name',
		ATTR_CONDITION		=> 'router like \'%news%\''
	);
	public static $questionCategoryId = array(
		ATTR_INDEX 		=> 'categoryId',
		ATTR_TYPE 			=> EDIT_TYPE_SELECT,
		ATTR_LABEL 		=> 'Danh mục cha',
		ATTR_TABLE 		=> 'categories',
		ATTR_SHOW_VALUE 	=> 'id',
		ATTR_SHOW_NAME 	=> 'name',
		ATTR_CONDITION		=> 'router like \'%ngonngu%\''
	);
	public static $level = array(
		ATTR_INDEX 		=> 'level',
		ATTR_TYPE 			=> EDIT_TYPE_TEXT,
		ATTR_LABEL 		=> 'Nhóm người dùng'
	);
	public static $meta_keywords = array(
		ATTR_INDEX 		=> 'meta_keywords',
		ATTR_TYPE 			=> EDIT_TYPE_TEXT_AREA,
		ATTR_LABEL 		=> 'Từ khóa liên quan'
	);
	public static $meta_description = array(
		ATTR_INDEX 		=> 'meta_description',
		ATTR_TYPE 			=> EDIT_TYPE_TEXT_AREA,
		ATTR_LABEL 		=> 'Từ khóa mô tả'
	);

	public static $keywords = array(
		ATTR_INDEX 		=> 'meta_keywords',
		ATTR_TYPE 			=> EDIT_TYPE_TEXT_AREA,
		ATTR_LABEL 		=> 'Từ khóa liên quan'
	);
	public static $description = array(
		ATTR_INDEX 		=> 'meta_description',
		ATTR_TYPE 			=> EDIT_TYPE_TEXT_AREA,
		ATTR_LABEL 		=> 'Từ khóa mô tả'
	);
	public static $campaignId = array(
		ATTR_INDEX 		=> 'campaignId',
		ATTR_TYPE 			=> EDIT_TYPE_SELECT,
		ATTR_LABEL 		=> 'Chiến dịch',
		ATTR_TABLE 		=> 'campaign',
		ATTR_SHOW_VALUE 	=> 'id',
		ATTR_SHOW_NAME 	=> 'name'
	);
	public static $status = array(
		ATTR_INDEX 		=> 'status',
		ATTR_TYPE 			=> EDIT_TYPE_STATUS,
		ATTR_LABEL 		=> 'Trạng thái'
	);
	public static $published = array(
		ATTR_INDEX 		=> 'published',
		ATTR_TYPE 			=> EDIT_TYPE_DATETIMEPICKER,
		ATTR_LABEL 		=> 'Ngày xuất bản'
	);
	public static $accountId = array(
		ATTR_INDEX 		=> 'accountId',
		ATTR_TYPE 			=> EDIT_TYPE_SELECT,
		ATTR_TABLE			=> 'social_account',
		ATTR_SHOW_VALUE	=> 'id',
		ATTR_SHOW_NAME		=> 'name',
		ATTR_LABEL 		=> 'Profile'
	);
	public static $router = array(
		ATTR_INDEX 		=> 'router',
		ATTR_TYPE 			=> EDIT_TYPE_TEXT,
		ATTR_LABEL 		=> 'Đường dẫn gốc'
	);
	public static $isSort = array(
		ATTR_INDEX 		=> 'isSort',
		ATTR_TYPE 			=> EDIT_TYPE_STATUS,
		ATTR_LABEL 		=> 'Sắp xếp'
	);
	public static $display = array(
		ATTR_INDEX 		=> 'display',
		ATTR_TYPE 			=> EDIT_TYPE_STATUS,
		ATTR_LABEL 		=> 'Display',
	);
	public static $parent = array(
		ATTR_INDEX 		=> 'parent',
		ATTR_TYPE 			=> EDIT_TYPE_SELECT,
		ATTR_TABLE 		=> 'categories',
		ATTR_LABEL 		=> 'Danh mục cha',
		ATTR_SHOW_NAME 	=> 'name',
		ATTR_SHOW_VALUE 	=> 'id'
	);
	public static $parentOfAreacode = array(
		ATTR_INDEX 		=> 'parent',
		ATTR_TYPE 			=> 'select',
		ATTR_TABLE 		=> 'areacode',
		ATTR_LABEL 		=> 'Địa phận',
		ATTR_SHOW_NAME 	=> 'name',
		ATTR_SHOW_VALUE 	=> 'id'
	);
	public static $parentOfAreatype = array(
		ATTR_INDEX 		=> 'parent',
		ATTR_TYPE 			=> 'select',
		ATTR_TABLE 		=> 'areatype',
		ATTR_LABEL 		=> 'Loại địa điểm cha',
		ATTR_SHOW_NAME 	=> 'name',
		ATTR_SHOW_VALUE 	=> 'id'
	);
	public static $parentOfCategory = array(
		ATTR_INDEX 		=> 'parent',
		ATTR_TYPE 			=> 'select',
		ATTR_LABEL 		=> 'Lọc theo danh mục',
		ATTR_TABLE 		=> 'categories',
		ATTR_SHOW_VALUE 	=> 'id',
		ATTR_SHOW_NAME 	=> 'name',
	);
	public static $question_types = array(
		ATTR_INDEX 		=> 'question_types',
		ATTR_TYPE 			=> EDIT_TYPE_MULTISELECT,
		ATTR_TABLE 		=> 'questiontype',
		ATTR_LABEL 		=> 'Chọn dạng bài tập',
		ATTR_SHOW_NAME 	=> 'name',
		ATTR_SHOW_VALUE 	=> 'id'
	);

	public static $position = array(
		ATTR_INDEX 		=> 'position',
		ATTR_TYPE 			=> EDIT_TYPE_TEXT,
		ATTR_LABEL 		=> 'Vị trí'
	);

	public static $url = array(
		ATTR_INDEX 		=> 'url',
		ATTR_TYPE 			=> EDIT_TYPE_TEXT,
		ATTR_LABEL 		=> 'Liên kết đích'
	);

	public static $width = array(
		ATTR_INDEX 		=> 'width',
		ATTR_TYPE 			=> EDIT_TYPE_TEXT,
		ATTR_LABEL 		=> 'Kích thước dài'
	);
	public static $height = array(
		ATTR_INDEX 		=> 'height',
		ATTR_TYPE 			=> EDIT_TYPE_TEXT,
		ATTR_LABEL 		=> 'Kích thước cao'
	);
	public static $videoUrl = array(
		ATTR_INDEX 		=> 'url',
		ATTR_TYPE 			=> EDIT_TYPE_FILE_MANAGER,
		ATTR_UPLOADTYPE	=> EDIT_TYPE_UPLOAD_TYPE_VIDEO,
		ATTR_LABEL 		=> 'Chọn Video',
	);
	public static $mediaUrl = array(
		ATTR_INDEX 		=> 'url',
		ATTR_TYPE 			=> EDIT_TYPE_FILE_MANAGER,
		ATTR_UPLOADTYPE	=> EDIT_TYPE_UPLOAD_TYPE_VIDEO,
		ATTR_LABEL 		=> 'Chọn Media',
	);
	public static $gradeNum = array(
		ATTR_INDEX 		=> 'gradeNum',
		ATTR_TYPE 			=> EDIT_TYPE_TEXT,
		ATTR_LABEL 		=> 'Khối'
	);
	public static $group_question = array(
		ATTR_INDEX 		=> 'group_question',
		ATTR_TYPE 			=> EDIT_TYPE_TEXT,
		ATTR_LABEL 		=> 'Dạng bài tập'
	);
	public static $question_type = array(
		ATTR_INDEX 		=> 'question_type',
		ATTR_TYPE 			=> EDIT_TYPE_TEXT,
		ATTR_LABEL 		=> 'Code'
	);

	public static $recommend = array(
		ATTR_INDEX 		=> 'recommend',
		ATTR_TYPE 			=> 'tinymce',
		ATTR_LABEL 		=> 'Nhập đoạn dịch'
	);

	public static $request = array(
		ATTR_INDEX 		=> 'request',
		ATTR_TYPE 			=> EDIT_TYPE_TEXT,
		ATTR_LABEL 		=> 'Yêu cầu'
	);

	public static $classes = array(
		ATTR_INDEX 		=> 'classes',
		ATTR_TYPE 			=> EDIT_TYPE_MULTISELECTOPTION,
		ATTR_LABEL 		=> 'Chọn lớp',
		'option' 		=> array(
			CLASS3 			=> "Lớp 3",
			CLASS4 			=> "Lớp 4",
			CLASS5 			=> "Lớp 5"
		)
	);

	public static $sharedSoftwares = array(
		ATTR_INDEX 		=> 'sharedSoftwares',
		ATTR_TYPE 			=> EDIT_TYPE_MULTISELECTOPTION,
		ATTR_LABEL 		=> 'Chia sẻ',
		'option' 		=> array(
			'1' 			=> "Full Look",
			'2' 			=> "IQ, EQ, CQ",
			'3' 			=> "Luyện viết văn",
			'4' 			=> "Trang chủ",
			'6' 			=> "Olympic",
			'7' 			=> "Thi tài",
			'8' 			=> "Thi tài Next Nobels",
		)
	);

	public static $target = array(
		ATTR_INDEX 		=> 'target',
		ATTR_TYPE 			=> 'selectoption',
		ATTR_LABEL 		=> 'Đích',
		'option' 		=> array(
			'_blank' 			=> "Blank",
			'static' 			=> "Cố định"
		)
	);

	public static $teacherId = array(
		ATTR_INDEX 		=> 'teacherId',
		ATTR_TYPE 			=> EDIT_TYPE_SELECT,
		ATTR_TABLE 		=> 'admin',
		ATTR_LABEL 		=> 'Giáo viên',
		ATTR_SHOW_NAME 	=> 'name',
		ATTR_SHOW_VALUE 	=> 'id',
		ATTR_CONDITION		=> 'usertype_id=5'
	);

	public static $classroomId = array(
		ATTR_INDEX 		=> 'classroomId',
		ATTR_TYPE 			=> EDIT_TYPE_SELECT,
		ATTR_TABLE 		=> 'education_classroom',
		ATTR_FIELDS		=> 'id, concat(schoolYear, gradeNum, className) as name',
		ATTR_LABEL 		=> 'Xếp lớp',
		ATTR_SHOW_NAME 	=> 'name',
		ATTR_SHOW_VALUE 	=> 'id'
	);

	public static $subjectId = array(
		ATTR_INDEX 		=> 'subjectId',
		ATTR_TYPE 			=> EDIT_TYPE_SELECT,
		ATTR_TABLE 		=> 'categories',
		ATTR_FIELDS		=> 'id, concat(name, classes) as subject',
		ATTR_LABEL 		=> 'Môn học',
		ATTR_SHOW_NAME 	=> 'subject',
		ATTR_SHOW_VALUE 	=> 'id',
		ATTR_CONDITION		=> 'type="subject"'
	);

	public static $typeOfDocument = array(
		ATTR_INDEX 		=> ATTR_TYPE,
		ATTR_TYPE 			=> 'selectoption',
		ATTR_LABEL			=> 'Loại tài liệu',
		'option'		=> array(
			'document'		=>	'Tài liệu',
			'vocabulary'	=>	'Từ vựng'
		)
	);

	public static $trial = array(
		ATTR_INDEX 		=> 'trial',
		ATTR_TYPE 			=> EDIT_TYPE_STATUS,
		ATTR_LABEL 		=> 'Dùng thử'
	);

	public static $typeOfAreacode = array(
		ATTR_INDEX 		=> ATTR_TYPE,
		ATTR_TYPE 			=> 'select',
		ATTR_TABLE 		=> 'areatype',
		ATTR_LABEL 		=> 'Loại địa điểm',
		ATTR_SHOW_NAME 	=> 'name',
		ATTR_SHOW_VALUE 	=> 'name'
	);

	public static $global = array(
		ATTR_INDEX 		=> 'global',
		ATTR_TYPE 			=> EDIT_TYPE_STATUS,
		ATTR_LABEL 		=> 'Toàn cục',
	);

	public static $yearNum = array(
		ATTR_INDEX 		=> 'yearNum',
		ATTR_TYPE 			=> EDIT_TYPE_TEXT,
		ATTR_LABEL 		=> 'Niên khóa'
	);

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
				ATTR_TYPE	=>	EDIT_TYPE_TEXT
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

function edit_fields($fields, $replace) {
	return PzkEditConstant::gets($fields, $replace);
}