<?php 
class PzkLanguageController extends PzkController 
{
	public $masterPage		=	'index';
	public $masterPosition	=	'wrapper';


	public function enAction() 
	{
		pzk_session('language', 'en');
		pzk_session('lang', 'en');
	}
	public function vnAction() 
	{
		pzk_session('language', 'vn');
		pzk_session('lang', 'vn');
	}
	public function evAction() 
	{
		pzk_session('language', 'ev');
		pzk_session('lang', 'ev');
	}
	
}