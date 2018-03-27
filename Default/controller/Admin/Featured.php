<?php
class PzkAdminFeaturedController extends PzkGridAdminController {
	public $title 		= 'Quản lý bài viết hay';
	public $table 		= 'featured';
	public function getJoins() {
		return PzkJoinConstant::gets('category, campaign, creator, modifier', 'featured');
	}

	public $selectFields = 'featured.*, categories.name as categoryName, campaign.name as campaignName, creator.name as creatorName, modifier.name as modifiedName';
	
	public function getListFieldSettings() { 
		return array(
			PzkListConstant::get('img', 'featured'),
			PzkListConstant::group('<br />Tiêu đề<br />Bí danh', 'title, alias', 'featured'),
			PzkListConstant::group('<br />Từ khóa<br />Mô tả', 'meta_keywords, meta_description', 'featured'),
			PzkListConstant::get('categoryName', 'featured'),
			PzkListConstant::get('campaignName', 'featured'),
			PzkListConstant::group('<br />Xem<br />Thích<br />Bình luận', 'views, likes, comments', 'featured'),
			PzkListConstant::group('<br />Người tạo<br />Người sửa', 'creatorName, modifiedName', 'featured'),
			PzkListConstant::group('<br />Ngày tạo<br />Ngày sửa', 'created, modified', 'featured'),
			PzkListConstant::group('<br />Ngày bắt đầu<br />Ngày kết thúc', 'startDate, endDate', 'featured'),
			PzkListConstant::get('ordering', 'featured'),
			PzkListConstant::get('status', 'featured'),
		);
	}
	
	public $searchLabel = 'Tìm kiếm';
	public $searchFields = array('`featured`.title', '`featured`.alias', '`categories`.name', '`campaign`.name');
	
	public function getFilterFields () { 
		return PzkFilterConstant::gets('featuredCategory, campaign', 'featured');
	}
	public function getSortFields() {
		return PzkSortConstant::gets('id, title, categoryId, ordering', 'featured');
	}
	
	public $quickMode = false;
	public function getQuickFieldSettings(){
		return PzkListConstant::gets('title', 'featured');
	}
	
	public $logable = true;
	public $logFields = 'title,alias,meta_keywords, meta_description';
	
	public $addLabel = 'Thêm tin tức';
	public $addFields = 'title, categoryId, campaignId, title, img, content, brief, alias, file, ordering,
				meta_keywords, meta_description, startDate, endDate, software, global, sharedSoftwares';
	public function getAddFieldSettings() { 
		return PzkEditConstant::gets('title, img, file, brief, content, alias, ordering, startDate, endDate, 
				categoryId, meta_keywords, meta_description, campaignId','featured');
    }
	
	public $editFields = 'title, categoryId,campaignId,title,img,content,brief,alias,file,ordering,meta_keywords,meta_description,
				startDate,endDate,software,global, sharedSoftwares';
    public function getEditFieldSettings() { 
		return PzkEditConstant::gets('title, img, file, brief, content, alias, ordering, startDate, endDate, 
				categoryId, meta_keywords, meta_description, campaignId','featured');
    }
	
	public $detailFields = 'featured.*, categories.name as categoryName, campaign.name as campaignName, creator.name as creatorName, modifier.name as modifiedName';
	public function getViewFieldSettings() { 
		return PzkListConstant::gets('title, alias, meta_keywords, meta_description, categoryName,
			campaignName, views, likes, comments, creatorName, modifiedName, created, modified, 
			startDate, endDate, statusText, orderingText, briefText, contentText', 'featured');
	}
	
	public function getChildrenGridSettings() { 
		return array(
			array(
				'index'	=> 'comments',
				'title'	=> 'Bình luận',
				'label'	=> 'Bình luận',
				'table'	=> 'featured_comment',
				'parentField'	=> 'featuredId',
				'addLabel'	=> 'Thêm bình luận',
				'quickMode'	=> false,
				'module'	=> 'featured_comment',
				'listFieldSettings'	=>  PzkListConstant::gets('comment, likes, ip, created', 'featured_comment'),
				'sortFields' => PzkSortConstant::gets('id, created, likes', 'featured_comment')
			),
			array(
				'index'	=> 'visitor',
				'title'	=> 'Người ghé thăm',
				'label'	=> 'Người ghé thăm',
				'table'	=> 'featured_visitor',
				'addLabel'	=> 'Thêm người ghé thăm',
				'quickMode'	=> false,
				'module'	=> 'visitor',
				'parentField'	=> 'featuredId',
				'listFieldSettings'	=> PzkListConstant::gets('ip, visited', 'featured_visitor'),
				'sortFields' => PzkSortConstant::gets('id, visited', 'featured_visitor')
			)
		);
	}
	
	public function getParentDetailSettings() { 
		return array(
			PzkParentConstant::get('creator', 'featured'),
			PzkParentConstant::get('modifier', 'featured'),
			PzkParentConstant::get('category', 'featured', PzkListConstant::gets('nameOfCategory, alias, router, statusText, displayText', 'category'))
		);
	}
}
	
?>