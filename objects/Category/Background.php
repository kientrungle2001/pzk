<?php
/**
 *
 */
class PzkCategoryBackground extends PzkObject
{
    public $table = 'categories';

    public function getBackground($categoryId) {
        $data = _db()->useCB()->select('*')
            ->from($this->table)
            ->where(array('id', $categoryId))->result_one();
        return $data;
    }
}
?>