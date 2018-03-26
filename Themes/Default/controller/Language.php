<?php 
class PzkLanguageController extends PzkController 
{
	public $masterPage		=	'index';
	public $masterPosition	=	'wrapper';


	public function enAction() 
	{
		pzk_session('language_tdn', 'en');
	}
	public function vnAction() 
	{
		pzk_session('language_tdn', 'vn');
	}
	public function evAction() 
	{
		pzk_session('language_tdn', 'ev');
	}
	
}