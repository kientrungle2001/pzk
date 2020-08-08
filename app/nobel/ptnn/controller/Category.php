<?php
/**
 *
 */
class PzkCategoryController extends PzkController
{
    public $masterPage = 'index';
    public $masterPosition = 'left';

    public function indexAction()
    {
        $this->layout();
        $this->page->display();
    }
    public function categoryAction()
    {
        $this->layout();
        $category = pzk_parse('<home.category table="categories" layout="home/category"/>');
        $left = pzk_element()->getLeft();
        $left->append($category);
        $this->page->display();
    }
    public function sectionAction()
    {
        $parent_id = pzk_request()->getSegment(3);
        $this->initPage();
        $this->append('category/section', 'left');
        $category = pzk_element()->getParent_category();
        $category->setParentCategoryId($parent_id);

        $this->display();
    }

    public function subSectionAction()
    {
        $parent_id = pzk_request()->getSegment(3);

        $this->initPage();
        $this->append('category/section', 'left');
        $category = pzk_element()->getParent_category();
        $category->setParentCategoryId($parent_id);

        $this->display();
    }

    public function lessonAction()
    {
        $parent_id = pzk_request()->getSegment(3);

        $this->initPage();
        $this->append('category/lesson', 'left');
        $category = pzk_element()->getParent_category();

        $config_category = array(
            '29'=> array(
                array(
                    'category_id'=> 7,
                    'name'=> 'Từ'
                ),
                array(
                    'category_id'=> 8,
                    'name'=> 'Câu'
                )
            ),
            '30'=> array(
                array(
                    'category_id'=> 9,
                    'name'=> 'Dàn ý'
                ),
                array(
                    'category_id'=> 10,
                    'name'=> 'Bài văn'
                )
            )
        );
        if($parent_id == 33 or $parent_id == 34  or $parent_id == 35) {
        $config_filter = array(
            array(
                'id'=> EASY,
                'name'=> "Cách 1: Cảm nhận nhận xét về đối tượng được tả"
            ),
            array(
                'id'=> NORMAL,
                'name'=> 'Cách 2'
            ),
            array(
                'id' => HARD,
                'name'=> 'Cách 3'
            )
        );
            $category->setConfigFilter($config_filter);
        }
        $category->setConfigCategory($config_category);
        $category->setParentCategoryId($parent_id);

        $this->display();
    }

    public function questionAction(){
        $keybook	= uniqid();
        pzk_session()->setKeyBook( $keybook);
        $this->initPage();
        $this->append('category/question', 'left');

        $this->display();
    }
    public function answerAction(){
    	
        $this->initPage();
        $this->append('category/answer', 'left');

        $this->display();
    }
    public function reviewAction(){

        $this->initPage();
        $this->append('category/review', 'left');

        $this->display();
    }
    public function checkSave($key){
        $check= _db()->getTableEntity('user_book');
        $check->loadWhere(array('keybook', $key));
        if($check->getId()){
            return false;
        }else return true;
    }
    public function ajaxAction() {
        $request = pzk_request();
        $postQuestion = $request->getAnswers();
        $key_test= $request->getKey();

        $startime = $postQuestion['stop_timer'];
        $realTime = ($postQuestion['time']*60) - (strtotime($startime) - 7*3600);
        debug($postQuestion);die();
        //$subject = $request->getSubject();
        //$tamtime = strtotime($_SERVER['REQUEST_TIME'] - $request->getStart_time()) - 7*3600;
        //echo $tamtime;
        $userbook=array('userId'=>pzk_session('userId'),
            'categoryId'=>$postQuestion['parent_id'],
            'quantity_question'=>$postQuestion['number'],
            'time'=>$postQuestion['time'],
            'time_do'=>$postQuestion['stop_timer'],
            'start_time'=>$startime,
            'mark_status'=>0,
            'keybook'=>$key_test,
            'date' => date("Y-m-d H:i:s")
        );
        if($key_test==pzk_session('keyBook')){
            if($this->checkSave($key_test)){
            //add user_book
                $frontendmodel = pzk_model('Frontend');
                $userbookId = $frontendmodel->save($userbook, 'user_book');
                //add user_answer
                $question_answers = $postQuestion['answers'];
                foreach($question_answers as $key => $val) {
                    $type = $frontendmodel->getTypeByQuestionId($key);
                    $user_answer = array(
                        'user_book_id' => $userbookId,
                        'questionId' => $key,
                        'question_type' => $type,
                        'content' => implode('|', $val)
                    );
                    if($type == 'Q2' or $type == 'Q21' or $type == 'Q26' or $type == 'Q29'){
                        $frontendmodel->save($user_answer, 'user_answers_text');
                    }elseif($type == 'Q0') {
                        $frontendmodel->save($user_answer, 'user_answers');
                    }

                }
                echo base64_encode(encrypt($userbookId, SECRETKEY));
            }
        }

    }
    public function markAction() {
        $request = pzk_request();
        $tam = $request->getBookid();
        $bookid = trim(decrypt(base64_decode($tam),SECRETKEY));
        if(is_numeric($bookid)) {
            $frontendmodel = pzk_model('Frontend');
            $row = array(
                'mark_status' => 1
            );
            $frontendmodel->save($row, 'user_book', $bookid);
        }
    }
    public function seeAnswerAction() {
        $request = pzk_request();
        $tam = $request->getIds();
        $arIds = explode(',', $tam);
        $frontendmodel = pzk_model('Frontend');
        $arResult = array();
        foreach($arIds as $item) {
            $type = $frontendmodel->getTypeByQuestionId($item);
            $result = '';
            if($type == 'Q2' or $type == 'Q21' or $type == 'Q29' or $type == 'Q22'){
                $answers = $frontendmodel->getAnswerByQuestionId($item);
                foreach($answers as $val) {
                    $result .= ', '.$val['content'];
                }
                if(!empty($result)) {
                    $result = substr($result,2);
                }
                $arResult[] = array(
                    'type' => $type,
                    'questionId' => $item,
                    'value' =>  $result
                );
            }elseif($type == 'Q0') {
                $answersTrue = $frontendmodel->getAnswerTrue($item);
                $arResult[] = array(
                    'type' => $type,
                    'questionId' => $item,
                    'value' =>  $answersTrue
                );
            }

        }
        echo json_encode($arResult) ;

    }
}
?>