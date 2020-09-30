<?php
/**
 * 
 */
class PzkStatic extends PzkObject {
	public $boundable = false;
  public $layout = 'empty';
  public $table = 'cms_static';
  public $conds = '["eq", "status", 1]';
  public $contentField = 'content';
  
  /**
   * @inheritdoc
   */
  public function display()
	{
		echo $this->getContent();
  }
  
  /**
   * @inheritdoc
   */
  public function getContent()
  {
    $item = _db()->select($this->getContentField())->from($this->getTable())->where($this->getConds())->result_one();
    if($item) return $item[$this->getContentField()];
    return null;
  }

  /**
   * Trả về conds để lấy bản ghi
   * @return Array $conds
   */
  protected function getConds() {
    $conds = '1';
    $condsValue = $this->get('conds');
    if(!is_array($condsValue)) {
      $conds = json_decode($condsValue, true);
    } else {
      $conds = $condsValue;
    }
    return $conds;
  }

  /**
   * @return String
   */
  protected function getTable() {
    return $this->get('table');
  }

  /**
   * @return String
   */
  protected function getContentField() {
    return $this->get('contentField');
  }
}
