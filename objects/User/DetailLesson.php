<?php
pzk_loader()->importObject('core/db/List');
/**
 *
 */
class PzkUserDetailLesson extends PzkCoreDbList
{
    public function getTypeByquestionId($questionId) {
        $data = _db()->useCB()->select('type')
            ->from('questions')
            ->where(array('id', $questionId))
            ->result_one();
        return $data['type'];
    }
}

?>