<?php

class PzkEducationQuestionLessonTest extends PzkObject{

    public function getQuestionByIds($ids,$limit=5) {
        $data = _db()->useCB()->select('*')->from($this->table)
            ->orderby('id desc')
            ->limit($limit, 0);

            $data->where(array('and', array('like', 'categoryIds', '%'.$ids.'%'), array('trial', 1)) );
        return $data->result();
    }

}
?>