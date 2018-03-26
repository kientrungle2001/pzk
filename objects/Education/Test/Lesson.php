<?php
/**
 *
 */
class PzkEducationTestLesson extends PzkObject
{
    public $layout = 'test/lesson';
    public $testId=false;
    public function getTest() {
        return _db()->getEntity('Test.Test')->load($this->get('testId'));
    }
    public function checkLevel($level){
        if($level=='1'){
            echo "Dễ";
        }
        if($level=='2'){
            echo "Bình thường";
        }
        if($level=='3'){
            echo "Khó";
        }
    }
    public function checkCategory($cate){
        if($cate=='58'){
            echo "BÀI KIỂM TRA VỀ TỪ";
        }
        if($cate=='59'){
             echo "BÀI KIỂM TRA VỀ CÂU";
        }
        if($cate=='60'){
             echo "BÀI KIỂM TRA VỀ ĐOẠN VĂN";
        }
        if($cate=='61'){
             echo "BÀI KIỂM TRA VỀ BÀI VĂN";
        }
    }
}
?>