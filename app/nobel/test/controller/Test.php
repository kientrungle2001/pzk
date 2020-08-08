<?php 
class PzkTestController extends PzkFrontendController 
{
	public $masterPage='index';
	public $masterPosition='left';
	public function titletestAction()
	{
		$categoryId = pzk_request()->getSegment(3);
		//$categoryId = 58;
		$this->initPage();	
		$titletest = $this->parse('test/titletest');
		$titletest->setCategoryId($categoryId);
		$this->append($titletest);
		$this->display();
	}
	public function testAction()
	{
		$id = pzk_request()->getId();
		$key_test= uniqid();
		pzk_session('keyTest',$key_test);
		$this->initPage();	
		$test = $this->parse('test/test');
		$test->setTestId($id);
		$this->append($test);
		$this->display();
	}
	public function lessonAction()
	{
		$id = pzk_request()->getId();
		$this->initPage();	
		$test = $this->parse('test/lesson');
		$test->setTestId($id);
		$this->append($test);
		$this->display();
	}
	public function fillAction()
	{
		$this->initPage();	
		$this->append('test/fill', 'left');
		$this->display();
	}
	public function checkSave($key){
		$check= _db()->getTableEntity('user_test_answer');
		$check->loadWhere(array('key', $key));
		if($check->getId()){
			return false;
		}else return true;
	}
	public function topicAction()
	{
		$this->initPage();	
		$this->append('test/topic', 'left');
		$this->display();
	}
	public function saveTestAction(){
		$request = pzk_request();
		$data_answers=$request->getAnswers();
		$key_test= $request->getKey();
		if($key_test==pzk_session('keyTest')){
			if($this->checkSave($key_test)){
				$question_id=$data_answers['question_id'];
				$question_type= $data_answers['question_type'];
				$category_id=$data_answers['categoryId'];
				$time=$data_answers['time'];
				$date= date("Y-m-d H:i:s");
				$quantity_question= $data_answers['quantity'];
				$userId=pzk_session('userId');
				$answerTest= _db()->getEntity('test.answer');
				$row= array('userId'=>$userId,'categoryId'=>$category_id,'time'=>$time,'quantity'=>$quantity_question,'date'=>$date,'key'=>$key_test);
				$answerTest->setData($row);
				$answerTest->save();
				$answerTestId=$answerTest->getId();
				$frontendmodel = pzk_model('Frontend');
				$answerDetail= _db()->getEntity('test.answerDetail');
				$answerDetailText= _db()->getEntity('test.answerDetailText');
				foreach ($question_id as $question) {
					$type = $frontendmodel->getTypeByQuestionId($question);
					$answer[$question]='';
					// Begin Các dạng về từ
					if($type == 'Q0' or $type == 'Q1'or $type == 'Q2' or $type == 'Q3' or $type == 'Q4' or $type == 'Q5' or $type == 'Q6' or $type == 'Q7'){
					// Điền càng nhiều từ càng tốt
					if($type == 'Q2' or $type == 'Q3' or $type == 'Q5' or $type == 'Q6'){
						$answers=$data_answers['answers'];
						$count=count($answers[$question]);
   						if($count>0){
							for($j=0; $j< $count; $j++){
								$answer[$question]=$answer[$question].$answers[$question][$j].'|';
							}
						}
					}
					// Sửa lỗi sai trong câu
					if($type== 'Q1'){
						$repair_false=$data_answers['repair_false'];
						$repair_true=$data_answers['repair_true'];
						$answer[$question]=$repair_false[$question].'|'.$repair_true[$question];
					}
					// Trắc nghiệm
					if($type== 'Q0' || $type== 'Q4'){
						$choice=$data_answers['choiceanswers'];
						if(isset($choice[$question])){
							$answer[$question]=$choice[$question];
						}
					}
					// Tìm từ theo chủ đề
					if($type== 'Q7'){
						$answersTopic=$data_answers['answerstopic'];
						$topicIds= $frontendmodel->getTopic($question);
						foreach ($topicIds as $topic){
							$id=$topic['id'];
							$countAnswers=count($answersTopic[$question][$id]);
							for($k=0; $k< $countAnswers; $k++){
								$answer[$question]=$answer[$question].$id.'.'.$answersTopic[$question][$id][$k].'|';
							}
						}
					}
					
   					$questionId=$question;
					$questionType=$question_type[$question];
					$rowAnswer=array('testAnswerId'=>$answerTestId,'questionId'=>$questionId,'questionType'=>$questionType,'content'=>$answer[$question]);
					$answerDetail->setData($rowAnswer);
					$answerDetail->save();
					}
					// End dạng về từ
					// Begin dạng về câu
					if($type == 'Q8' or $type == 'Q9'or $type == 'Q10' or $type == 'Q11' or $type == 'Q12' or $type == 'Q13' or $type == 'Q14' or $type == 'Q15' or $type == 'Q16' or $type == 'Q17'){
						// Chọn đáp án sai và sửa lại thành đúng
						if($type == 'Q8'){
							$rdoanswers=$data_answers['rdochoicerepair'];
							$txtanswers=$data_answers['txtchoicerepair'];
							if(isset($rdoanswers[$question])){
								$answer[$question]=$rdoanswers[$question];
							}
							if(isset($txtanswers[$question])){
								$answer[$question]=$answer[$question].'|'.$txtanswers[$question];
							};
						}
						if($type == 'Q9' || $type == 'Q10'){
							$addsentence=$data_answers['addsentence'];
							$answer[$question]=$addsentence[$question];
						}
						$questionId=$question;
						$questionType=$question_type[$question];
						$rowAnswer=array('testAnswerId'=>$answerTestId,'questionId'=>$questionId,'questionType'=>$questionType,'content'=>$answer[$question]);
						$answerDetailText->setData($rowAnswer);
						$answerDetailText->save();
					}
					// End dạng về câu
				}
				echo base64_encode(encrypt($answerTestId, SECRETKEY));
			}
		}

	}
	public function sendTestMarkAction(){
		$user_test_id=pzk_request()->getUser_test_id();
		$user_test_id = decrypt(base64_decode($user_test_id),SECRETKEY);
		$answerTest= _db()->getEntity('test.answer');
		$answerTest->loadWhere(array('id',$user_test_id));
		$answerTest->update(array('mark_status'=>'1'));
		echo "1";
	}
	public function showAnswerTestAction(){
    $request = pzk_request();
    $data_answers=$request->getAnswers();
	$tam=$data_answers['question_id'];
    
    $frontendmodel = pzk_model('Frontend');
    foreach($tam as $item) {
	    $type = $frontendmodel->getTypeByQuestionId($item);
        $result = '';
        if($type == 'Q2' or $type == 'Q3' or $type == 'Q5' or $type == 'Q6'){
            $answers = $frontendmodel->getAnswerByQuestionId($item);
            $arResultFill = array(
                'type' => $type,
                'questionId' => $item,                    
                'value' =>  array()
            );
            foreach ($answers as $val) {
            	$arResultFill['value'][]=$val['content'];
            }
                
                $arResult[] = $arResultFill;
        }
        if($type == 'Q0' or $type == 'Q4') {
                $answersTrue = $frontendmodel->getAnswerChoice($item);
                $arResult[] = array(
                    'type' => $type,
                    'questionId' => $item,
                    'value' =>  $answersTrue
                );
        }
        if($type == 'Q7') {
                $topicIds= $frontendmodel->getTopic($item);
                $topic_content='';
                $answers_content='';
                $id_topic='';
                $arrItem = array(
                    'type' => $type,
                    'questionId' => $item,
                    'topics' => array()
                );
                foreach($topicIds as $topicId) {
                	$arrItem['topics'][$topicId['id']] = array(
                		'content' => $topicId['content'],
                		'answers' => array()
                	);
                	$answers = $frontendmodel->getAnswerTopic($item,$topicId['id']);
                	foreach($answers as $val) {
                		$arrItem['topics'][$topicId['id']]['answers'][] 
                		= array('content' => $val['content']);
                	}
                }
                $arResult[] = $arrItem;
        }
        if($type == 'Q8') {
                $answers = $frontendmodel->getChoiceRepair($item);
                $arResult[] = array(
                    'type' => $type,
                    'questionId' => $item,
                    'value' =>  $answers['content'],
                    'contentfull'=> $answers['content_full']
                );
        }

    }
        echo json_encode($arResult) ;

	}
}
 ?>