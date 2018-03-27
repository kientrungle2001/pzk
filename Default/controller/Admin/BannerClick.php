<?php
class PzkAdminBannerclickController extends PzkGridAdminController {
	public $table = 'banner_click';
	public $joins = array(
		array(
			'table' => 'banner',
			'condition' => 'banner_click.bannerId = banner.id',
			'type' => 'left'
		)
	);
	public $sortFields = array(
		'banner_click.id asc' => 'ID tăng',
		'banner_click.id desc' => 'ID giảm',
		'banner_click.timeclick asc' => 'Ngày tăng',
		'banner_click.timeclick desc' => 'Ngày giảm',	
	);
	public $selectFields = 'banner_click.*, banner.name as bannerName';
	public $filterFields = array(
		array(
            'index' => 'bannerId',
            'type' => 'select',
            'label' => 'Theo banner',
            'table' => 'banner',
            'show_value' => 'id',
            'show_name' => 'name',
        )
	);
	public $searchFields = array('bannerId','utm_source','utm_campaign');
	
	public $listFieldSettings = array(
		array(
            'index' => 'bannerName',
            'type' => 'text',
            'label' => 'Tên banner'
        ),
		array(
            'index' => 'ip',
            'type' => 'text',
            'label' => 'IP'
        ),
		array(
            'index' => 'utm_source',
            'type' => 'text',
            'label' => 'Nguồn'
        ),
		array(
            'index' => 'utm_campaign',
            'type' => 'text',
            'label' => 'Chiến dịch'
        ),
		array(
            'index' => 'timeclick',
            'type' => 'text',
            'label' => 'Thời gian ghé thăm'
        )
    );
}