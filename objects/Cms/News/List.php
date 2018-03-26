<?php 
pzk_import('Core.Db.List');
class PzkCmsNewsList extends PzkCoreDbList
{
	public $layout 			= 'cms/news/list';
	public $table 			= 'news';
	public $joins 			= array(
		array(
			'table'			=> 'categories',
			'type'			=> 'left',
			'condition'		=> 'news.categoryId=categories.id'
		)
	);
	public $fields = 'news.*, categories.parents';
	public $orderBy = 'news.created desc, news.id desc';
	public $parentMode = true;
	public $parentField = 'parents';
	public $parentWhere = 'like';
	public $parentId = null;
	public $showThumbnail = true;
	public $showBrief = true;
	public $titleTag = 'h2';
	public $briefTag = 'em';
	public $listType = 'row'; // 
	
	public static $settings = array(
		array(
			'index' 	=> 'id',
			'type'		=> 'text',
			'label'		=> 'ID'
		),
		array(
			'index' 	=> 'listType',
			'type'		=> 'selectoption',
			'label'		=> 'Kiểu danh sách',
			'option'	=> array(
				'row'	=> 'Dạng dòng',
				'list'	=> 'Dạng danh sách'
			)
		),
		array(
			'index' 	=> 'parentId',
			'type'		=> 'select',
			'label'		=> 'Tin tức',
			'table'		=> 'categories',
			'show_name'	=> 'name',
			'show_value'=> 'id'
		),
		array(
			'index' 	=> 'orderBy',
			'type'		=> 'selectoption',
			'label'		=> 'Sắp xếp theo',
			'option'	=> array(
				'news.created asc'	=> 'Bài cũ trước',
				'news.created desc'	=> 'Bài mới trước',
				'news.id asc'	=> 'ID tăng',
				'news.id desc'	=> 'ID giảm',
				'news.likes desc'	=> 'Nhiều lượt thích',
				'news.views desc'	=> 'Nhiều lượt hiển thị',
				'news.comments desc'	=> 'Nhiều lượt bình luận',
			)
		),
		array(
			'index' 	=> 'showThumbnail',
			'type'		=> 'selectoption',
			'label'		=> 'Hiển thị Thumbnail',
			'option'	=> array(
				'true'	=> 'Có',
				'false'	=> 'Không'
			)
		),
		array(
			'index' 	=> 'showBrief',
			'type'		=> 'selectoption',
			'label'		=> 'Hiển thị Mô tả',
			'option'	=> array(
				'true'	=> 'Có',
				'false'	=> 'Không'
			)
		),
		array(
			'index' 	=> 'titleTag',
			'type'		=> 'text',
			'label'		=> 'Thẻ tiêu đề'
		),
		array(
			'index' 	=> 'briefTag',
			'type'		=> 'text',
			'label'		=> 'Thẻ Mô tả'
		),
		array(
			'index' 	=> 'ulClass',
			'type'		=> 'text',
			'label'		=> 'Class cho danh sách'
		),
		array(
			'index' 	=> 'liClass',
			'type'		=> 'text',
			'label'		=> 'Class cho dòng'
		),
	);
	public function getNewsByCateId($id) {
		$data = _db()->useCache(1800)
			->useCacheKey('news-categoryId-'.$id)
            ->select('*')
            ->from('news')
            ->where(array('categoryId', $id))
            ->orderBy('id desc')
            ->result();
		return $data;
	}
}