<?php
define('JOIN_TYPE_DEFAULT', '');
define('JOIN_TYPE_INNER', 'inner');
define('JOIN_TYPE_OUTER', 'outer');
define('JOIN_TYPE_LEFT', 'left');
define('JOIN_TYPE_RIGHT', 'right');
define('JOIN_TABLE_CATEGORY', 'category');
define('JOIN_TABLE_CREATOR', 'creator');
define('JOIN_TABLE_MODIFIER', 'modifier');

class PzkJoinConstant
{
	public static $aqs_question = array(
		ATTR_TABLE 		=> 'aqs_question',
		ATTR_CONDITION 	=> '{replace}.questionId = aqs_question.id',
		ATTR_TYPE 		=> JOIN_TYPE_LEFT
	);
	public static $campaign = array(
		ATTR_TABLE 		=> 'campaign',
		ATTR_CONDITION 	=> '{replace}.campaignId = campaign.id',
		ATTR_TYPE 		=> JOIN_TYPE_LEFT
	);
	public static $category = array(
		ATTR_TABLE 		=> 'categories',
		ATTR_CONDITION 	=> '{replace}.categoryId = categories.id',
		ATTR_TYPE 			=> JOIN_TYPE_LEFT
	);
	public static $creator = array(
		ATTR_TABLE 		=> '`admin` as `creator`',
		ATTR_CONDITION 	=> '{replace}.creatorId = creator.id',
		ATTR_TYPE 			=> JOIN_TYPE_LEFT
	);
	public static $modifier = array(
		ATTR_TABLE 		=> '`admin` as `modifier`',
		ATTR_CONDITION 	=> '{replace}.modifiedId = modifier.id',
		ATTR_TYPE 			=> JOIN_TYPE_LEFT
	);
	public static $news = array(
		ATTR_TABLE		=> 	'news',
		ATTR_CONDITION	=> 	'{replace}.newsId = news.id',
		ATTR_TYPE		=> JOIN_TYPE_LEFT
	);
	public static $social_account = array(
		ATTR_TABLE		=> 	'social_account',
		ATTR_CONDITION	=> 	'social_schedule.accountId = social_account.id',
		ATTR_TYPE		=> JOIN_TYPE_LEFT
	);
	public static $social_app = array(
		ATTR_TABLE		=> 	'social_app',
		ATTR_CONDITION	=> 	'social_account.appId = social_app.id',
		ATTR_TYPE		=> JOIN_TYPE_LEFT
	);
	public static $featured = array(
		ATTR_TABLE 	=> 'featured',
		ATTR_CONDITION => '{replace}.featuredId = featured.id',
		ATTR_TYPE 		=> JOIN_TYPE_LEFT
	);
	public static $user = array(
		ATTR_TABLE 	=> 'user',
		ATTR_CONDITION => '{replace}.userId = user.id',
		ATTR_TYPE 		=> JOIN_TYPE_LEFT
	);
	public static function  get($field, $replace)
	{
		$dom = pzk_parse_selector($field);
		$tagName = $dom['tagName'];
		$result = self::$$tagName;
		foreach ($dom['attrs'] as $attr) {
			$result[$attr['name']] = $attr['value'];
		}
		$result[ATTR_CONDITION] = str_replace('{replace}', $replace, $result[ATTR_CONDITION]);
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
