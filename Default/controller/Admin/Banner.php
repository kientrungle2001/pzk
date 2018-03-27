<?php
class PzkAdminBannerController extends PzkGridAdminController {
	public $title = 'Quản lý Banner';
	public $table = 'banner';
	public function getJoins() {
		return PzkJoinConstant::gets ( 'campaign, creator, modifier', 'banner' );
	}
	
	public function getFilterFields() {
		return PzkFilterConstant::gets ( 'campaign[compact=true]', 'banner' );
	}
	public $selectFields = 'banner.*, campaign.name as campaignName,creator.name as creatorName, modifier.name as modifiedName';
	public $addFields = 'image, url, name, position, campaignId, campaign, website, width, height, target, software, global, sharedSoftwares';
	public $editFields = 'image, url, name, position, campaignId, campaign, website, width, height, target, software, global, sharedSoftwares';
	public $logable = true;
	public $logFields = 'image, url, name, position, campaignId, campaign, website, width, height';
	public function getSortFields() {
		return PzkSortConstant::gets ( 'id, created, name', 'banner' );
	}
	public $searchFields = array('name', 'image');
	
	public function getListFieldSettings() {
		return array (
				PzkListConstant::get ( 'image', 'banner' ),
				PzkListConstant::get ( 'nameOfCommon', 'banner' ),
				PzkListConstant::get ( 'position', 'banner' ),
				PzkListConstant::get ( 'url', 'banner' ), 
				PzkListConstant::get ( 'campaignName', 'banner' ),
				
				PzkListConstant::group ( '<br />Người tạo<br />Người sửa', 'creatorName, modifiedName', 'news' ),
				PzkListConstant::group ( '<br />Ngày tạo<br />Ngày sửa', 'created, modified', 'news' ),
				PzkListConstant::get ( 'click', 'banner' ),
				PzkListConstant::get ( 'width', 'banner' ),
				PzkListConstant::get ( 'height', 'banner' ),
				PzkListConstant::get ( 'status', 'banner' ) 
		);
	}
	public function getViewFieldSettings() {
		return array (
				PzkListConstant::get ( 'image', 		'banner' ),
				PzkListConstant::get ( 'name', 			'banner' ),
				PzkListConstant::get ( 'position', 		'banner' ),
				PzkListConstant::get ( 'url', 			'banner' ), 
				PzkListConstant::get ( 'campaignName', 	'banner' ),
				
				PzkListConstant::group ( '<br />Người tạo<br />Người sửa', 'creatorName, modifiedName', 						'banner' ),
				PzkListConstant::group ( '<br />Ngày tạo<br />Ngày sửa', 'created, modified', 										 'banner' ),
				PzkListConstant::get ( 'click', 		'banner' ),
				PzkListConstant::get ( 'width', 		'banner' ),
				PzkListConstant::get ( 'height', 		'banner' ),
				PzkListConstant::get ( 'statusText', 	'banner' ) 
		);
	}
	
	public function getParentDetailSettings() {
		return array (
				PzkParentConstant::get ( 'creator', 	'banner' ),
				PzkParentConstant::get ( 'modifier', 	'banner' ), 
		);
	}
    public $addLabel = 'Thêm Banner';
	public function getAddFieldSettings() {
		return PzkEditConstant::gets ( 'name[mdsize=12], image[mdsize=12],
				position[mdsize=4], width[mdsize=4], height[mdsize=4],
				campaignId[mdsize=4], 
				url[mdsize=4],
				target[mdsize=4]', 						'banner' );
	}
    
    public function getEditFieldSettings() {
		return PzkEditConstant::gets ( 'name[mdsize=12], image[mdsize=12],
				position[mdsize=4], width[mdsize=4], height[mdsize=4],
				campaignId[mdsize=4], 
				url[mdsize=4],
				target[mdsize=4]', 						'banner' );
	}
	public function getAddValidator() {
		return PzkValidatorConstant::gets(
			array(
				'name' => array(
					'required' => true, 'minlength' => 2, 'maxlength' => 500
				)
			)
		);
	}
    
    public function getEditValidator() {
		return PzkValidatorConstant::gets(
			array(
				'name' => array(
					'required' => true, 'minlength' => 2, 'maxlength' => 500
				)
			)
		);
	}
	public function codeAction($id){
		$content	=	_db()->useCB()->select('*')->from('banner')->where(array('id', $id))->result_one();
		$str		= 	'<a href="/banner/bannerPost?id=' . $id . '&utm_source=' . $content['website'] . '&utm_campaign=' . $content['campaign'] . '">';
		$str2 		=	'<img src="' . $content['image'] . '" style="width:' . $content['width'] . 'px; height:' . $content['height'] . 'px;" />';
		$html= html_escape("<div>" . $str . $str2 . "</a></div>");
		echo $html;

	}
}