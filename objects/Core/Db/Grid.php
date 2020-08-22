<?php
pzk_import('Core.Db.List');
class PzkCoreDbGrid extends PzkCoreDbList {
    public $joins = false;
    public $scriptable = true;
    public $layout = 'admin/grid/index/view/grid';
    public function prepareQuery($query) {
        if(is_string($this->joins))
            $this->joins = json_decode($this->joins, true);
        $join = $this->joins;
        if($join) {
            foreach($join as $val) {
                $query->join($val['table'], $val['condition'], isset($val['type']) ? $val['type'] : null);
            }
        }
    }
}
