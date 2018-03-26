<?php
class PzkCMSSupport extends PzkObject {
	public $layout = 'cms/support';
	public static $settings = array(
			array(
                    'index' => 'hotline',
                    'type' => 'text',
                    'label' => 'Số hotline'
            ),
            array(
                    'index' => 'email',
                    'type' => 'text',
                    'label' => 'Email hỗ trợ'
            ),
            array(
                    'index' => 'yahoo',
                    'type' => 'text',
                    'label' => 'Yahoo hỗ trợ'
            ),
            array(
                    'index' => 'skype',
                    'type' => 'text',
                    'label' => 'Skype hỗ trợ'
            )
	);
}
?>