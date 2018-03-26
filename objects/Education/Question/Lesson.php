<?php
/**
 *
 */
class PzkEducationQuestionLesson extends PzkObject
{
    public $parentCategoryId;
    public function listCate()
    {
        $listCate = _db()->select('*')->from($this->table)->result();
        return $listCate;
    }
    public function getCateByParent() {
        $listCate = _db()->useCB()->select('*')->from($this->table)->where(array('parent', $this->getParentCategoryId()))->result();
        return $listCate;
    }
    public function getEpcate() {
        $parent = _db()->useCB()->select('parent')->from($this->table)->where(array('id', $this->getParentCategoryId()))->result_one();
        $listCate = _db()->useCB()->select('*')->from($this->table)->where(array('parent',$parent['parent']))->result();
        return $listCate;
    }
    public function  getTopicByCategoryId($category_id) {
        $data = _db()->useCB()
            ->select('id, name')
            ->from('topics')
            ->where(array('and', array('category_id', $category_id), array('status', 1)))
            ->result();
        return $data;
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