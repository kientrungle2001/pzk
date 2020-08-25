<?php
class PzkAdminNewsController extends PzkGridAdminController {
	public $title = 'Quản lý tin tức';
	public $table = 'news';
	public function getLinks() {
		return array(
			array(
				'name'	=> 	'Thêm nhanh',
				'href'	=> 	'/Admin_News/add?status=1&hidden_ordering=1&hidden_global=1&hidden_campaignId=1&hidden_sharedSoftwares=1&hidden_startDate=1&hidden_endDate=1&hidden_status=1'
			),
			
			array(
				'name'	=> 	'Thêm bài nháp',
				'href'	=> 	'/Admin_News/add?status=1&hidden_ordering=1&hidden_global=1&hidden_campaignId=1&hidden_sharedSoftwares=1&hidden_startDate=1&hidden_endDate=1&hidden_status=1, &hidden_brief=1&hidden_img=1&hidden_meta_keywords=1&hidden_meta_description=1'
			)
		);
	}
	public function getJoins() {
		return PzkJoinConstant::gets ( 'category, campaign, creator, modifier', 'news' );
	}
	public $selectFields = 'news.*, categories.name as categoryName, campaign.name as campaignName, creator.name as creatorName, modifier.name as modifiedName';
	public function getListFieldSettings() {
		return array (
				PzkListConstant::get ( 'img', 'news' ),
				PzkListConstant::group ( '<br />Tiêu đề<br />Bí danh', 'title, alias', 'news' ),
				PzkListConstant::group ( '<br />Từ khóa<br />Mô tả', 'meta_keywords, meta_description', 'news' ),
				PzkListConstant::get ( 'categoryName', 'news' ),
				PzkListConstant::get ( 'campaignName', 'news' ),
				PzkListConstant::group ( '<br />Xem<br />Thích<br />Bình luận', 'views, likes, comments', 'news' ),
				PzkListConstant::group ( '<br />Người tạo<br />Người sửa', 'creatorName, modifiedName', 'news' ),
				PzkListConstant::group ( '<br />Ngày tạo<br />Ngày sửa', 'created, modified', 'news' ),
				PzkListConstant::group ( '<br />Ngày bắt đầu<br />Ngày kết thúc', 'startDate, endDate', 'news' ),
				PzkListConstant::get ( 'ordering', 'news' ),
				PzkListConstant::get ( 'status', 'news' ),
				PzkListConstant::get ( 'featured', 'news' )				
		);
	}
	public $searchLabel = 'Tìm kiếm';
	public $searchFields = array (
			'`news`.title',
			'`news`.alias',
			'`categories`.name',
			'`campaign`.name' 
	);
	public function getFilterFields() {
		return PzkFilterConstant::gets ( 'newsCategory[compact=true], campaign[compact=true]', 'news' );
	}
	public function getSortFields() {
		return PzkSortConstant::gets ( 'id, title, categoryId, ordering', 'news' );
	}
	public $quickMode = false;
	public function getQuickFieldSettings() {
		return PzkListConstant::gets ( 'title', 'news' );
	}
	public $logable = true;
	public $logFields = 'title, alias, meta_keywords, meta_description';
	public $addLabel = 'Thêm tin tức';
	public $addFields = 'title, categoryId, campaignId, img, content, brief, alias, file, ordering,
				meta_keywords, meta_description, startDate, endDate, software, global, sharedSoftwares';
	public function getAddFieldSettings() {
		return PzkEditConstant::gets ( 'title[mdsize=4], alias[mdsize=4],
				categoryId[mdsize=4], 
				img[mdsize=2], meta_keywords[mdsize=5], meta_description[mdsize=5],
				content[mdsize=12], brief[mdsize=12], 
				ordering[mdsize=2], status[mdsize=2], startDate[mdsize=3], endDate[mdsize=3], global[mdsize=2], 
				campaignId[mdsize=12], sharedSoftwares', 'news' );
	}
	public $editFields = 'title, categoryId,campaignId,title,img,content,brief,alias,file,ordering,meta_keywords,meta_description,
				startDate,endDate,software,global, sharedSoftwares';
	public function getEditFieldSettings() {
		return PzkEditConstant::gets ( 'title[mdsize=4], alias[mdsize=4],
				categoryId[mdsize=4], 
				img[mdsize=2], meta_keywords[mdsize=5], meta_description[mdsize=5],
				content[mdsize=12], brief[mdsize=12], 
				ordering[mdsize=2], status[mdsize=2], startDate[mdsize=3], endDate[mdsize=3], global[mdsize=2], 
				campaignId[mdsize=12], sharedSoftwares', 'news' );
	}
	public $detailFields = 'news.*, categories.name as categoryName, campaign.name as campaignName, creator.name as creatorName, modifier.name as modifiedName';
	public function getViewFieldSettings() {
		return PzkListConstant::gets ( 'title, alias, meta_keywords, meta_description, categoryName,
			campaignName, views, likes, comments, creatorName, modifiedName, created, modified, 
			startDate, endDate, statusText, orderingText, briefText, contentText', 'news' );
	}
	public function getChildrenGridSettings() {
		return array (
				PzkGridConstant::get ( 'comments', 'news', array (
						'listFieldSettings' => PzkListConstant::gets ( 'comment, likes, ip, created', 'news_comment' ),
						'sortFields' => PzkSortConstant::gets ( 'id, created, likes', 'news_comment' ) 
				) ),
				PzkGridConstant::get ( 'visitors', 'news', array (
						'listFieldSettings' => PzkListConstant::gets ( 'ip, visited', 'news_visitor' ),
						'sortFields' => PzkSortConstant::gets ( 'id, visited', 'news_visitor' ) 
				) ),
				PzkGridConstant::get ( 'social_schedules', 'news', array (
						'joins' => PzkJoinConstant::gets ( 'news, social_account, social_app', 'social_schedule' ),
						'sortFields' => PzkSortConstant::gets ( 'id, name, created', 'social_schedule' ),
						'listFieldSettings' => PzkListConstant::gets ( 'typeOfApp, accountType, appName, accountName, nameOfNews, published, created, status', 'social_schedule' ) 
				) ) 
		);
	}
	public function getParentDetailSettings() {
		return array (
				PzkParentConstant::get ( 'creator', 'news' ),
				PzkParentConstant::get ( 'modifier', 'news' ),
				PzkParentConstant::get ( 'category', 'news', PzkListConstant::gets ( 'nameOfCategory, alias, router, statusText, displayText', 'category' ) ) 
		);
	}
	public function getUpdateDataTo() {
		return array (
				array (
						'index' => 'social_schedule',
						'table' => 'social_schedule',
						'selectField' => array (
								'id' => 'newsId' 
						),
						'label' => 'Đặt lịch facebook',
						'data' => PzkEditConstant::gets ( 'accountId, published, status', 'social_schedule' ) 
				) 
		);
	}
	
	public function verifyAction() {
		$arr = array();
		$ids = pzk_request()->getIds();
		$rows = _db()->selectAll()->from($this->getTable())->inId($ids)->result();
		foreach ($rows as $row) {
			if(!$row['meta_keywords']) {
				$arr[] = array(
						'error'		=> true,
						'id'		=> $row['id'],
						'message'	=> 'Thiếu từ khóa'
				);
			}
			if(!$row['meta_description']) {
				$arr[] = array(
						'error'		=> true,
						'id'		=> $row['id'],
						'message'	=> 'Thiếu mô tả'
				);
			}
			if(!$row['img']) {
				$arr[] = array(
						'error'		=> true,
						'id'		=> $row['id'],
						'message'	=> 'Thiếu hình ảnh'
				);
			}
		}
		echo json_encode($arr);
	}
}

?>