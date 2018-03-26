<?php
class PzkGameGameOther extends PzkObject {
    public function getFrameGame($gameType, $table) {
        $data = _db()->select('*')
            ->from($table)
            ->where(array('gamecode', $gameType));
        return $data->result_one();
    }
}