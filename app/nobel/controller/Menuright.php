<?php 
class PzkMenurightController extends  PzkController
{
	public $masterPage='index';
	public $masterPosition='right';
	
	const PAGE_ESUPPORT = 'cms/esuport';
	const PAGE_VNSUPPORT = 'cms/vnsupport';
	const PAGE_COURSE = 'cms/course';
	const PAGE_IMAGE = 'cms/image';
	const PAGE_LIBRARYIMG = 'cms/libraryimg';
	
	
	public function esupportAction() 
	{
		$this->render(self::PAGE_ESUPPORT);
	}
	public function vnsupportAction() 
	{
		$this->render(self::PAGE_VNSUPPORT);
	}	
	public function cour->setAction() 
	{
		$this->render(self::PAGE_COURSE);
	}
	public function imageAction() 
	{
		$this->render(self::PAGE_IMAGE);
	}
	public function libraryimgAction() 
	{
		$this->render(self::PAGE_LIBRARYIMG);
	}	
}
 ?>