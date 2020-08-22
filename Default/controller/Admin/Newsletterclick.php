<?php
class PzkAdminNewsletterClickController extends PzkGridAdminController {
	public $table = 'newsletter_click';
	public $joins = array(
		array(
			'table'		=> 	'newsletter_newsletter',
			'condition'	=>	'newsletter_click.newsletterId = newsletter_newsletter.id',
			'type'		=> JOIN_TYPE_LEFT
		)
	);
	public $selectFields = 'newsletter_click.*, newsletter_newsletter.subject as newsletterSubject';
	public $sortFields = array(
		'newsletter_click.id asc' => 'ID tăng',
		'newsletter_click.id desc' => 'ID giảm',
		'newsletter_click.time asc' => 'code tăng',
		'newsletter_click.time desc' => 'code giảm',
	);
	
	public $listFieldSettings = array(
		array(
            'index' => 'newsletterSubject',
            'type' => 'text',
            'label' => 'Tên thư báo'
        ),
        array(
            'index' => 'time',
            'type' => 'text',
            'label' => 'Thời gian'
        ),
		array(
            'index' => 'ip',
            'type' => 'text',
            'label' => 'IP'
        )
	);
    
}
	
?>