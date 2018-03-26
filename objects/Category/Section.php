<?php
/**
 *
 */
class PzkCategorySection extends PzkObject
{
    public $parentCategoryId;
    public function listCate()
    {
        $listCate = _db()->select('*')->from($this->table)->result();
        return $listCate;
    }
    public function getCateByParent() {
        $listCate = _db()->useCB()->select('*')
            ->from($this->table)
            ->where(array('parent', $this->getParentCategoryId()))->result();
        return $listCate;
    }
    public function getVideo() {
        $data = _db()->useCB()->select('url,id')
            ->from('video')
            ->where(array('category_id', $this->getParentCategoryId()))
            ->result_one();
            return $data;
    }
}
?>