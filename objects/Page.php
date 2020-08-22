<?php
class PzkPage extends PzkObject
{

	public $title = 'Pzk Page';
	public $layout = 'page';
	public $keywords = '';
	public $description = '';
	public $jsFiles = array(
		'/jquery-1.7.1.min.js',
		'/components.js'
	);
	public $jsInstances = array();
	public $cssFiles = array();
	public $lessFiles = array();
	public $cssExternals = array();
	public $lessExternals = array();
	public $style = false;
	public $scriptable = false;

	public $boundable = false;
	public $template = false;

	/**
	Them duong dan javascript
	Cac duong dan javascript duoc them vao nay se duoc noi vao thanh 1 file javascript chung
	 */
	public function addJs($js)
	{
		if (!in_array($js, $this->jsFiles)) {
			$this->jsFiles[] = $js;
		}
	}

	/**
	Them duong dan khoi tao doi tuong javascript
	 */
	public function addObjJs($obj)
	{
		$this->addJs('/js/' . $obj . '.js');
	}

	/**
		Them mot obj instance javascript khi scriptable = true
	 */
	public function addJsInst($obj)
	{
		$this->jsInstances[] = $obj;
	}

	public function addCss($link)
	{
		if (!in_array($link, $this->cssFiles)) {
			$this->cssFiles[] = $link;
		}
	}

	public function addLess($link)
	{
		if (!in_array($link, $this->lessFiles)) {
			$this->lessFiles[] = $link;
		}
	}

	public function addExternalCss($link)
	{
		if (!in_array($link, $this->cssExternals)) {
			$this->cssExternals[] = $link;
		}
	}

	public function addExternalLess($link)
	{
		if (!in_array($link, $this->lessExternals)) {
			$this->lessExternals[] = $link;
		}
	}

	public function addObjCss($obj)
	{
		$css = pzk_app()->getTemplateUri($obj . '.css');
		$this->addCss($css);
	}

	public function addObjLess($obj)
	{
		$css = pzk_app()->getTemplateUri($obj . '.less');
		$this->addLess($css);
	}

	public function cacheJs()
	{
	}

	public function cacheCss()
	{
	}

	public function finish()
	{
		$this->cacheCss();
		$this->cacheJs();
	}

	public function getTemplatePath($path)
	{
		$app = pzk_app();
		$page = pzk_page();
		return BASE_URL . '/design/' . $app->name . '/' . $page->template . '/' . $path;
	}
}

/**
 * Return page object
 *
 * @return PzkPage
 */
function pzk_page()
{
	return pzk_element()->getPage();
}
