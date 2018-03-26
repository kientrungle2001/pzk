<?php
/**
 *
 */
class PzkEducationQuestionVideo extends PzkObject
{
    public $layout = 'question/video';
    public function getVideo($id) {
        $data = _db()->useCB()->select('url,id')
            ->from('video')
            ->where(array('category_id', $id));
        //echo $data->getQuery();
        return $data->result_one();
    }
}
?>