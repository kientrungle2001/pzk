<?php 
pzk_import('Cms.News.List');
class PzkCmsNewsRelateds extends PzkCmsNewsList
{
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
}